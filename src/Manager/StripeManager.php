<?php


namespace App\Manager;


use App\Entity\Commande;
use App\Entity\LineCommande;
use App\Entity\Produit;
use App\Entity\User;
use App\Service\StripeService;
use Doctrine\ORM\EntityManagerInterface;

class StripeManager
{
    protected $stripeService;
    protected $em;

    public function __construct(StripeService $stripeService, EntityManagerInterface $em)
    {
        $this->stripeService = $stripeService;
        $this->em = $em;
    }

    public function intentSecret($total){
        $intent = $this->stripeService->paymentIntent($total);
        return $intent['client_secret'] ?? null;
    }

    public function stripe(array $stripeParameter, $total){
        $resource = null;
        $data = $this->stripeService->stripe($stripeParameter, $total);
        if($data){
            $resource = [
                'stripeBrand' => $data['charges']['data'][0]['payment_method_details']['card']['brand'],
                'stripeLast4' => $data['charges']['data'][0]['payment_method_details']['card']['last4'],
                'stripeId' => $data['charges']['data'][0]['id'],
                'stripeStatus' => $data['charges']['data'][0]['status'],
                'stripeToken' => $data['client_secret']
            ];
        }
        return $resource;
    }

    public function creatCommand(array $resource, ?Produit $produit, User $user){
        $command = new Commande();
        $line = new LineCommande();
        $command->setUser($user)
            ->setBrandStripe($resource['stripeBrand'])
            ->setLast4Stripe($resource['stripeLast4'])
            ->setIdChargeStripe($resource['stripeId'])
            ->setStatusStripe($resource['stripeStatus'])
            ->setStripeToken($resource['stripeToken']);
        $this->em->persist($command);
        $this->em->flush();
    }
}