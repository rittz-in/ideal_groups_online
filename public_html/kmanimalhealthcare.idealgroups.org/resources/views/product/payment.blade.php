@extends('layouts.guest')

@section('content')
    <section class="text-center">
        <style>
            .refresh {
                max-width: 100%;
                height: 100vh;
            }
        </style>
        <img src="{{ asset('siteassets/images/refresh_page.svg') }}" class="img-fluid refresh rounded-top" alt="" />
    </section>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        window.onload = function() {
            var options = {
                "key": "{{ env('RAZORPAY_KEY') }}",
                "amount": "{{ $order_detail->total_amount * 100 }}",
                "currency": "INR",
                "name": "KM Animal",
                "description": "Razorpay payment",
                "image": "{{ asset('siteassets/images/favicon.png') }}",
                "handler": function(response) {
                    // After payment is successful, send the payment ID and other details to your server
                    $.ajax({
                        url: '{{ route('razorpay.payment.store') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            razorpay_payment_id: response.razorpay_payment_id,
                            order_id: '{{ $order_detail->id }}',
                            amount: '{{ $order_detail->total_amount }}'
                        },
                        success: function(result) {
                            // Redirect to the success page or handle success response
                            window.location.href =
                                '{{ route('product.success', ['orderNumber' => $order_detail->order_number]) }}';
                        },
                        error: function(err) {
                            // Handle error response
                            alert('Payment failed. Please try again.');
                        }
                    });
                },
                "prefill": {
                    "name": "{{ $user->name ?? 'Card Holder Name' }}",
                    "email": "{{ $user->email ?? 'user@email.com' }}"
                },
                "theme": {
                    "color": "#F7942A"
                },
                "modal": {
                    "ondismiss": function() {
                        // Redirect to another route when the modal is closed
                        window.location.href = '{{ route('site') }}'; // Change this to your desired route
                    }
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
        }
    </script>
@endsection
