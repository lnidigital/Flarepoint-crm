@extends('layouts.master')

@section('content')
@push('scripts')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip(); //Tooltip on icons top

            $('.popoverOption').each(function () {
                var $this = $(this);
                $this.popover({
                    trigger: 'hover',
                    placement: 'left',
                    container: $this,
                    html: true,

                });
            });
        });
    </script>
@endpush
    <div class="div">

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            @foreach($referralsThisMonth as $thisMonth)
                                {{$thisMonth->total}}
                            @endforeach
                        </h3>

                        <p>{{ __('Referrals this month') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-book-outline"></i>
                    </div>
                    <a href="{{route('referrals.index')}}" class="small-box-footer">{{ __('All Referrals') }} <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            @foreach($onetoonesThisMonth as $thisMonth)
                                {{$thisMonth->total}}
                            @endforeach
                        </h3>

                        <p>{{ __('1-to-1s completed this month') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('onetoones.index')}}" class="small-box-footer">{{ __('All 1-to-1s') }} <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>@foreach($guestsThisMonth as $thisMonth)
                                {{$thisMonth->total}}
                            @endforeach</h3>

                        <p>{{ __('Guests this month') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="{{route('guests.index')}}" class="small-box-footer">{{ __('All guests') }} <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>@foreach($revenuesThisMonth as $thisMonth)
                                ${{$thisMonth->total}}
                            @endforeach</h3>
                        <p>{{ __('Total revenue generated') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer"> {{ __('More info') }} <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->

        <?php $createdReferralsEachMonths = array(); $referralCreated = array();?>
        @foreach($createdReferralsMonthly as $referral)
            <?php $createdReferralsEachMonths[] = date('F', strTotime($referral->created_at)) ?>
            <?php $referralCreated[] = $referral->month;?>
        @endforeach

        <?php $createdRevenueEachMonths = array(); $revenueCreated = array();?>
        @foreach($createdRevenuesMonthly as $revenue)
            <?php $createdRevenueEachMonths[] = date('F', strTotime($revenue->created_at)) ?>
            <?php $leadCreated[] = $revenue->month;?>
        @endforeach

        <?php $createdOnetoOneEachMonths = array(); $onetoOneCreated = array();?>
        @foreach($createdOnetoOnesMonthly as $onetoone)
            <?php $createdOnetoOneEachMonths[] = date('F', strTotime($onetoone->created_at)) ?>
            <?php $onetoOneCreated[] = $onetoone->month;?>
        @endforeach

        <div class="row">

            @include('partials.dashboardgrow')


        </div>
@endsection
