@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
            <div class="row">
                    <div class="col-xl-12 mb-5 mb-xl-0">
                        <div class="card shadow">
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="mb-0">Savings</h3>
                                    </div>
                                    <div class="col text-right">
                                        <a href="{{ route('home') }}" class="btn btn-sm btn-primary">See all</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>

                            <div class="table-responsive">
                                <!-- Projects table -->
                                <table class="table align-items-center table-flush" id="savings-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Paid By</th>
                                            <th scope="col">Payment Type</th>
                                            <th scope="col">Payed For</th>
                                            <th scope="col">Notes</th>
                                        </tr>
                                    </thead>
                                    @if (count($transactions)>0)
                                        @foreach ($transactions as $transaction)
                                            <tbody>
                                        <tr>
                                            <th scope="row">
                                                    {{$transaction->date}}
                                            </th>
                                            <td scope="col" class="sort" data-sort="amount">
                                                    {{$transaction->amount}}
                                            </td>
                                            <td>
                                                    {{$transaction->owner_name}}
                                            </td>
                                            <td>
                                                    {{$transaction->payment_type}}
                                            </td>
                                            <td>
                                                    {{$transaction->payed_for}}
                                            </td>
                                            <td>
                                                    {{$transaction->notes}}
                                            </td>
                                                     <td class="text-right">
                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                            @if ($transaction)
                                                            <form action="{{ route('transactions.destroy', $transaction) }}" method="post">
                                                                @csrf
                                                                @method('delete')

                                                                    <a class="dropdown-item" href="{{ route('transactions.edit', $transaction) }}">{{ __('Edit') }}</a>
                                                                    <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                                        {{ __('Delete') }}
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <a class="dropdown-item" href="{{ route('transactions.edit') }}">{{ __('Edit') }}</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                        </tr>

                                    </tbody>
                                        @endforeach

                                    @else
                                        <p>No transactions</p>
                                    @endif

                                </table>
                            </div>
                            <hr>
                                <div class="card-header border-0">
                                    <div class="row align-items-center">
                                    {{$transactions->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <div class="row mt-3">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card bg-gradient-default shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                                <h2 class="text-white mb-0">Sales value</h2>
                            </div>
                            <div class="col">
                                <ul class="nav nav-pills justify-content-end">
                                    <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}' data-prefix="$" data-suffix="k">
                                        <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                                            <span class="d-none d-md-block">Month</span>
                                            <span class="d-md-none">M</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}' data-prefix="$" data-suffix="k">
                                        <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                                            <span class="d-none d-md-block">Week</span>
                                            <span class="d-md-none">W</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
                            <!-- Chart wrapper -->
                            <canvas id="chart-sales" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

@endpush


