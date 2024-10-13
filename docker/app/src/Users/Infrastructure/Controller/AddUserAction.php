<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Controller;

use App\Share\Application\Message\MessageBusInterface;
use App\Share\Domain\Validation\Validator;
use App\Share\Infrastructure\Exception\AppException;
use App\Share\Infrastructure\Services\Billing\Contracts\ServiceInterface;
use App\Users\Domain\Factory\UserFactory;
use App\Users\Domain\Mapper\UserMapper;
use App\Users\Domain\Message\ExternalMessageToForward;
use App\Users\Infrastructure\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/api/users', methods: ['POST'])]
class AddUserAction extends AbstractController
{
    public function __construct(
        private UserRepository      $repository,
        private UserFactory         $factory,
//        private readonly ServiceInterface $billingService,
        private Validator           $validator,
        private UserMapper          $mapper,
        private MessageBusInterface $messageBus,
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $errors = $this->validator->validate($data, $this->mapper->getValidationCollectionCreateUser());
        if ($errors) {
            throw new AppException(current($errors)->getFullMessage());
        }
        $user = $this->factory->create($data['email'], $data['password']);
//        $result = $this->billingService->createAccount($user->getUlid());
//        if (!$result->isSuccess()) {
//            throw new \Exception($result->getMessage());
//        };

        $this->repository->add($user);
        $message = new ExternalMessageToForward('user_created', [
            'name' => $data['name'],
            'age' => $data['age'] ?? null,
            'user_id' => $user->getId()
        ]);
        $envelope = new Envelope($message, [new AmqpStamp("#")]);

        $this->messageBus->execute($envelope);

        return new JsonResponse(['user_id' => $user->getUlid()]);
    }
}
