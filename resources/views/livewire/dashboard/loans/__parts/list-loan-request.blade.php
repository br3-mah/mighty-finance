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
        <div class="animate-slide-fade bg-white rounded shadow-sm py-2">
            <div class="row flex-column flex-md-row justify-content-even">
                <div class="col-md-5 col-xs-12">
                    <div class="flex items-center">
                        <span class="h-3 w-3 mr-2 rounded-full bg-green-500"></span>
                        <span class="font-bold"> <b>K{{ number_format($loan->amount, 2, '.', ',') }}</b> </span>
                        <br>
                        <small class="text-gray-600 text-xs">Applied on {{ $loan->created_at->toFormattedDateString() }}</small>
                    </div>
                    <p class="text-gray-600">{{ $loan->type }} Loan</p>
                </div>
                <div class="col-md-3 col-xs-12">
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
                <div class="col-md-4 col-xs-3">
                    <div class="btn-group">
                        <a href="{{ route('loan-details',['id' => $loan->id]) }}" class="btn btn-info sharp tp-btn">
                            <i style="color: rgb(241, 233, 233)" class="fa fa-eye"></i>
                        </a>
                        <a target="_blank" title="View Loan Statement" href="{{ route('loan-statement', ['id'=>$loan->id]) }}" class="btn btn-primary shadow btn-xs sharp">
                            <i class="bi bi-file-earmark-ruled"></i>
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