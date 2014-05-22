<?php

namespace Pfe\Bundle\BookingBundle\Controller\Frontend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\DiExtraBundle\Annotation as DI;
use JMS\Payment\CoreBundle\Entity\Payment;
use JMS\Payment\CoreBundle\PluginController\Result;
use JMS\Payment\CoreBundle\Plugin\Exception\ActionRequiredException;
use JMS\Payment\CoreBundle\Plugin\Exception\Action\VisitUrl;
use Pfe\Bundle\BookingBundle\Entity\Booking;
use Pfe\Bundle\BookingBundle\Form\BookingCreate;

/**
 * Booking controller.
 *
 */
class BookingController extends Controller
{

    public function newAction(Request $request)
    {
        $entity = new Booking();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $customer = $this->get('security.context')->getToken()->getUser();
            $event = $em->getRepository('PfeEventBundle:Event')->findOneBySlugAndLocale($request->get('slug'), $request->getLocale());
            $entity->setCustomer($customer);
            $entity->setEvent($event);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pfe_frontend_booking_payment', array('token' => $entity->getEvent()->getToken())));
        }

        return $this->redirect($this->generateUrl('frontend_event_show', array('slug' => $entity->getEvent()->getSlug())));

    }

    /**
    * Creates a form to create a Customer entity.
    *
    * @param Booking $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Booking $entity)
    {
        $form = $this->createForm(new BookingCreate(), $entity, array(
            'action' => $this->generateUrl('customer_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /** @DI\Inject */
    private $request;

    /** @DI\Inject */
    private $router;

    /** @DI\Inject("doctrine.orm.entity_manager") */
    private $em;

    /** @DI\Inject("payment.plugin_controller") */
    private $ppc;

    public function paymentAction(Request $request)
    {

        $form = $this->getFormFactory()->create('jms_choose_payment_method', null, array(
            'amount'   => 12.99,
            'currency' => 'EUR',
            'default_method' => 'payment_paypal', // Optional
            'predefined_data' => array(
                'paypal_express_checkout' => array(
                    'return_url' => $this->router->generate('payment_complete', array(
                            'orderNumber' => $request->get('token'),
                        ), true),
                    'cancel_url' => $this->router->generate('payment_cancel', array(
                            'orderNumber' => $request->get('token'),
                        ), true)
                ),
            ),
        ));

        if ('POST' === $this->request->getMethod()) {
            $form->bindRequest($this->request);

            if ($form->isValid()) {
                $this->ppc->createPaymentInstruction($instruction = $form->getData());

                $order->setPaymentInstruction($instruction);
                $this->em->persist($order);
                $this->em->flush($order);

                return new RedirectResponse($this->router->generate('payment_complete', array(
                    'orderNumber' => $order->getOrderNumber(),
                )));
            }
        }

        return $this->render('PfeBookingBundle:Frontend:payment.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /** @DI\LookupMethod("form.factory") */
    protected function getFormFactory() { }
}
