<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Subscription;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Main Controller.
 *
 * Note: please keep in mind that is only for testing purposes. Security checks and other important flow controls aren't
 * contemplated at this example... because... yes it is an example! :)
 */
class MainController extends Controller
{
    public function index()
    {
        return $this->renderIndex();
    }

    public function buy($product, $user)
    {
        $product = $this->getProductRepository()->find($product);
        $user    = $this->getUserRepository()->find($user);

        try {

            $subscription = $this->get('terox.subscription.manager')->create($product, 'end_last');
            $subscription->setUser($user);

            // You can do this step in other service (or moment) if you want.
            // You must activate the subscription explicitly!
            $this->get('terox.subscription.manager')->activate($subscription);

            $this->save($subscription);

        } catch(\Exception $exception) {

            return $this->renderIndex($exception);
        }

        return $this->renderIndex();
    }

    public function disable($id)
    {
        $subscription = $this->getSubscription($id);

        try {

            $this->get('terox.subscription.manager')->disable($subscription);
            $this->save($subscription);

        } catch(\Exception $exception) {

            return $this->renderIndex($exception);
        }

        return $this->renderIndex();
    }

    public function expire($id)
    {
        $subscription = $this->getSubscription($id);

        try {

            $this->get('terox.subscription.manager')->expire($subscription);
            $this->save($subscription);

        } catch(\Exception $exception) {

            return $this->renderIndex($exception);
        }

        return $this->renderIndex();
    }

    public function renew($id)
    {
        $subscription = $this->getSubscription($id);

        try {

            $newSubscription = $this->get('terox.subscription.manager')->renew($subscription);
            $this->save($subscription);
            $this->save($newSubscription);

        } catch(\Exception $exception) {

            return $this->renderIndex($exception);
        }

        return $this->renderIndex();
    }

    private function renderIndex($errorMessage = false)
    {
        return $this->render('index.html.twig', [
            'subscriptions' => $this->getSubscriptionRepository()->findAll(),
            'products'      => $this->getProductRepository()->findAll(),
            'users'         => $this->getUserRepository()->findAll(),
            'errorMessage'  => $errorMessage,
            'errorClass'    => $errorMessage !== false ? get_class($errorMessage) : ''
        ]);
    }

    private function getSubscription($id)
    {
        return $this->getSubscriptionRepository()->find($id);
    }

    private function save($object)
    {
        $this->getDoctrine()->getManager()->persist($object);
        $this->getDoctrine()->getManager()->flush();
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager
     */
    private function getSubscriptionRepository()
    {
        return $this->getDoctrine()->getRepository(Subscription::class);
    }

    private function getProductRepository()
    {
        return $this->getDoctrine()->getRepository(Product::class);
    }

    private function getUserRepository()
    {
        return $this->getDoctrine()->getRepository(User::class);
    }
}