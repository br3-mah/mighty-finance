<div class="media-body">
    @if($my_loan !== null)
    <div class="row mb-4 mt-2">
        <div class="col-xl-6 col-lg-6 col-sm-12 col-xs-12 pt-3">
            @if($my_loan !== null)
                <span class=" text-black">
                    @if($my_loan->status == 1)
                    Amount Borrowed
                    @else
                    Amount Request
                    @endif
                </span>
                <h2 class="fs-30 font-w600 ">K {{ $my_loan->amount ?? 0.00 }}</h2>
                @if($my_loan->complete == 1)
                <h4 class="mb-0 font-w500 text-white">
                    @if($my_loan->status == 0)
                    <span class="badge badge-sm light badge-danger">
                        <i class="fa fa-circle text-danger me-1"></i>
                        Pending for Approval
                    </span>
                    @elseif($my_loan->status == 1)
                    <span class="badge badge-sm light badge-success">
                        <i class="fa fa-circle text-success me-1"></i>
                        Accepted
                    </span>
                    @elseif($my_loan->status == 2)
                    <span class="badge badge-sm light badge-warning">
                        <i class="fa fa-circle text-warning me-1"></i>
                        Under Review
                    </span>
                    @else
                    <span class="badge badge-sm light badge-default">
                        <i class="fa fa-circle text-warning me-1"></i>
                        Rejected
                    </span>
                    @endif
                </h4>
            @else 
                <span class="badge badge-sm light badge-default">
                    <i class="fa fa-circle text-warning me-1"></i>
                    Incomplete KYC Profile
                </span>
            @endif
            @endif
        </div>
        <div class="col-xl-6 col-lg-6 col-sm-12 col-xs-12 pt-3 bg-primary">
            @if($my_loan !== null)
                <span class="fs-18 text-white d-block mb-2">
                    Payback Amount
                </span>
                <h2 class="fs-30 text-white font-w600 ">K {{ $my_loan->amount ?? 0.00 }}</h2>
            @endif
        </div>
    </div>
    <div class="row">
        
        @if($my_loan !== null)
            
            @if($my_loan->status == 1)
            <div class="value-data col-xl-6 col-md-6 col-12">
                <p class="mb-1 text-black">Duration</p>
                <h4 class="mb-0 font-w500 text-primary">{{ $my_loan->repayment_plan }} Months</h4>
            </div>
            <div class="value-data col-xl-6 col-md-6 col-12">
                <p class="mb-1 text-black">Due Date</p>
                <h4 class="mb-0 font-w500 text-xs text-primary">
                    @php 
                        $date_str = $my_loan->loan->final_due_date;
                        $date = DateTime::createFromFormat('Y-m-d H:i:s', $date_str);
                        echo $date->format('F j, Y, g:i a');
                    @endphp  
                </h4>
            </div>
            <div class="value-data col-xl-12 col-md-12 col-12 mt-4">
                <span style="color:#fff" class="text-black py-4">
                    @php
                        // Convert the target date/time to a Unix timestamp
                        $targetTimestamp = strtotime($date_str);
    
                        // Calculate the difference between the target timestamp and the current timestamp
                        $diff = $targetTimestamp - time();
    
                        // Calculate the number of days remaining
                        $daysRemaining = floor($diff / (60 * 60 * 24));
    
                        // Calculate the number of hours remaining
                        $hoursRemaining = floor(($diff % (60 * 60 * 24)) / (60 * 60));
    
                        // Calculate the number of minutes remaining
                        $minutesRemaining = floor(($diff % (60 * 60)) / 60);
    
                        // Calculate the number of seconds remaining
                        $secondsRemaining = $diff % 60;
    
                       if ($daysRemaining < 0) {
                        echo "Payback payment is overdue";
                       }else {
                        echo "{$daysRemaining} Days  {$hoursRemaining} Hours remaining";
                       }
                        // Output the remaining time in a human-readable format
                        // echo "{$daysRemaining} Days  {$hoursRemaining} Hours {$minutesRemaining} Minutes {$secondsRemaining} Seconds remaining";
                    @endphp
                </span>
            </div>
            @endif
        @endif
    </div>
    @endif
</div>