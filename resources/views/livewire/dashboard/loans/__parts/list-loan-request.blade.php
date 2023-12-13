<style>
    @keyframes slide-fade-up {
    0% {
        transform: translateY(50px);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
    }

    .animate-slide-fade {
    opacity: 0;
    animation: slide-fade-up 0.5s ease-out forwards;
    }

</style>
<div wire:ignore class="col-xl-12 col-md-12 col-sm-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-8">
        @forelse($loan_requests as $loan)
        <div class="animate-slide-fade bg-white p-4 rounded shadow-sm">
          <div class="row col-12">
            <div class="col-xl-5 col-xs-3">
                <div class="flex items-center">
                    <span class="h-3 w-3 mr-2 rounded-full bg-green-500"></span>
                    <span class="font-bold">K{{ number_format($loan->amount, 2, '.', ',') }}</span>
                </div>
                <p class="text-gray-600">{{ $loan->type }}</p>
                <p class="text-gray-600">{{ $loan->created_at->toFormattedDateString() }}</p>
            </div>
            <div class="col-xl-3">
                @if($loan->status == 0)
                <span class="badge badge-sm text-danger light badge-danger">
                    <i class="fa fa-circle text-danger me-1"></i>
                    Pending
                </span>
                @elseif($loan->status == 1)
                <span class="badge badge-sm text-success light badge-success">
                    <i class="fa fa-circle text-success me-1"></i>
                    Accepted
                </span>
                @elseif($loan->status == 2)
                <span class="badge badge-sm  text-warning light badge-warning">
                    <i class="fa fa-circle text-warning me-1"></i>
                    Under Review
                </span>
                @else
                <span class="badge badge-sm text-warning light badge-default">
                    <i class="fa fa-circle text-warning me-1"></i>
                    Rejected
                </span>
                @endif
            </div>
            <div class="col-xl-4 col-xs-3">
                <div class="btn sharp tp-btn ms-auto">
                    <a href="{{ route('loan-details',['id' => $loan->id]) }}">  
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                        </svg>                                                
                    </a>
                </div>
                &nbsp;
                <div class="btn sharp tp-btn ms-auto">
                    <a target="_blank" title="View Loan Statement" href="{{ route('loan-statement', ['id'=>$loan->id]) }}" class="btn btn-primary shadow btn-xs sharp me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-ruled" viewBox="0 0 16 16">
                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5v2zM3 12v-2h2v2H3zm0 1h2v2H4a1 1 0 0 1-1-1v-1zm3 2v-2h7v1a1 1 0 0 1-1 1H6zm7-3H6v-2h7v2z"/>
                        </svg>
                    </a>
                </div>
            </div>
          </div>
        </div>
        
        @empty
        @endforelse
    </div>
    <script>
        // Wait for the page to fully load
        document.addEventListener("DOMContentLoaded", function () {
            const cards = document.querySelectorAll(".card");
            // Apply animation to each card with a delay
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 300}ms`; // Use backticks (`) for string interpolation
            });
        });
    </script>
</div>