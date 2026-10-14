<?php

namespace App\Mail;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;
    public float $calculatedSubtotal;
    public float $calculatedDeliveryFee;
    public float $calculatedDiscount;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order, float $subtotal, float $deliveryFee, float $discount)
    {
        $this->order = $order;
        $this->calculatedSubtotal = $subtotal;
        $this->calculatedDeliveryFee = $deliveryFee;
        $this->calculatedDiscount = $discount;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmed! Your FoodieHub Order #' . $this->order->order_number . ' & Invoice',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.order-success',
            with: [
                'order' => $this->order,
                'calculatedSubtotal' => $this->calculatedSubtotal,
                'calculatedDeliveryFee' => $this->calculatedDeliveryFee,
                'calculatedDiscount' => $this->calculatedDiscount,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $pdf = Pdf::loadView('invoices.order-pdf', [
            'order' => $this->order,
            'calculatedSubtotal' => $this->calculatedSubtotal,
            'calculatedDeliveryFee' => $this->calculatedDeliveryFee,
            'calculatedDiscount' => $this->calculatedDiscount,
        ]);
        $pdf->setPaper('a4', 'portrait');

        return [
            Attachment::fromData(fn () => $pdf->output(), 'FoodieHub-Invoice-' . $this->order->order_number . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
