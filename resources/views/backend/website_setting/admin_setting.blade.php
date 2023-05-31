@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">WebSite Data</li>
                        </ol>
                    </div>
                    <div class="col-sm-6"></div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-info">
                            <div class="card-body p-0">
                                <div class="modal-body">
                                    <form action="{{route('admin.website.setting.data.store')}}" method="POST" class="form-example">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Financial Months</label>
                                                        <select name="financial_months" class="form-control select2">
                                                            <option value="">Select Financial Months</option>
                                                            <option value="January" @if(optional($financial_month)->image == 'January') selected @endif>January</option>
                                                            <option value="February" @if(optional($financial_month)->image == 'February') selected @endif>February</option>
                                                            <option value="March" @if(optional($financial_month)->image == 'March') selected @endif>March</option>
                                                            <option value="April" @if(optional($financial_month)->image == 'April') selected @endif>April</option>
                                                            <option value="May" @if(optional($financial_month)->image == 'May') selected @endif>May</option>
                                                            <option value="June" @if(optional($financial_month)->image == 'June') selected @endif>June</option>
                                                            <option value="July" @if(optional($financial_month)->image == 'July') selected @endif>July</option>
                                                            <option value="August" @if(optional($financial_month)->image == 'August') selected @endif>August</option>
                                                            <option value="September" @if(optional($financial_month)->image == 'September') selected @endif>September</option>
                                                            <option value="October" @if(optional($financial_month)->image == 'October') selected @endif>October</option>
                                                            <option value="November" @if(optional($financial_month)->image == 'November') selected @endif>November</option>
                                                            <option value="December" @if(optional($financial_month)->image == 'December') selected @endif>December</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <button type="submit" class="btn btn-outline-success mt-1 mb-1" onclick="return confirm('Are you sure you want to Save this Data?');"><i class="fa fa-check" aria-hidden="true"></i> Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
