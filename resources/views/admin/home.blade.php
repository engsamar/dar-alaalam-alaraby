@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <img src="assets/images/users/avatar-1.jpg" alt=""
                                        class="avatar-md rounded-circle img-thumbnail">
                                </div>
                                <div class="flex-grow-1 align-self-center">
                                    <div class="text-muted">
                                        <p class="mb-2">Welcome to Skote Dashboard</p>
                                        <h5 class="mb-1">Henry wells</h5>
                                        <p class="mb-0">UI / UX Designer</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 align-self-center">
                            <div class="text-lg-center mt-4 mt-lg-0">
                                <div class="row">
                                    <div class="col-4">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Total Projects</p>
                                            <h5 class="mb-0">48</h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Projects</p>
                                            <h5 class="mb-0">40</h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Clients</p>
                                            <h5 class="mb-0">18</h5>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 d-none d-lg-block">
                            <div class="clearfix mt-4 mt-lg-0">
                                <div class="dropdown float-end">
                                    <button class="btn btn-primary" type="button" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bxs-cog align-middle me-1"></i> Setting
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-4">
            <div class="card bg-primary bg-soft">
                <div>
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-3">
                                <h5 class="text-primary">Welcome Back !</h5>
                                <p>Skote Saas Dashboard</p>

                                <ul class="ps-3 mb-0">
                                    <li class="py-1">7 + Layouts</li>
                                    <li class="py-1">Multiple apps</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                        <i class="bx bx-copy-alt"></i>
                                    </span>
                                </div>
                                <h5 class="font-size-14 mb-0">Orders</h5>
                            </div>
                            <div class="text-muted mt-4">
                                <h4>1,452 <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>
                                <div class="d-flex">
                                    <span class="badge badge-soft-success font-size-12"> + 0.2% </span>
                                    <span class="ms-2 text-truncate">From previous period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                        <i class="bx bx-archive-in"></i>
                                    </span>
                                </div>
                                <h5 class="font-size-14 mb-0">Revenue</h5>
                            </div>
                            <div class="text-muted mt-4">
                                <h4>$ 28,452 <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>
                                <div class="d-flex">
                                    <span class="badge badge-soft-success font-size-12"> + 0.2% </span>
                                    <span class="ms-2 text-truncate">From previous period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                        <i class="bx bx-purchase-tag-alt"></i>
                                    </span>
                                </div>
                                <h5 class="font-size-14 mb-0">Average Price</h5>
                            </div>
                            <div class="text-muted mt-4">
                                <h4>$ 16.2 <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>

                                <div class="d-flex">
                                    <span class="badge badge-soft-warning font-size-12"> 0% </span>
                                    <span class="ms-2 text-truncate">From previous period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4 h4 card-title">Latest Transaction</div>
                    <div class="mb-2 row"></div>
                    <div class="table-responsive">
                        <table role="table" class="table">
                            <thead>
                                <tr role="row">
                                    <th class="">
                                        <div class="m-0">#</div>
                                    </th>
                                    <th class="">
                                        <div class="m-0" title="Toggle SortBy"
                                            style="cursor: pointer;">Order ID</div>
                                    </th>
                                    <th class="">
                                        <div class="m-0" title="Toggle SortBy"
                                            style="cursor: pointer;">Billing Name</div>
                                    </th>
                                    <th class="">
                                        <div class="m-0" title="Toggle SortBy"
                                            style="cursor: pointer;">Date</div>
                                    </th>
                                    <th class="">
                                        <div class="m-0" title="Toggle SortBy"
                                            style="cursor: pointer;">Total</div>
                                    </th>
                                    <th class="">
                                        <div class="m-0" title="Toggle SortBy"
                                            style="cursor: pointer;">Payment Status</div>
                                    </th>
                                    <th class="">
                                        <div class="m-0" title="Toggle SortBy"
                                            style="cursor: pointer;">Payment Method</div>
                                    </th>
                                    <th class="">
                                        <div class="m-0" title="Toggle SortBy"
                                            style="cursor: pointer;">View Details</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody role="rowgroup">
                                <tr>
                                    <td role="cell"><input type="checkbox"
                                            class="form-check-input"></td>
                                    <td role="cell"><a class="text-body fw-bold"
                                            href="/dashboard">#SK2540</a></td>
                                    <td role="cell">Neal Matthews</td>
                                    <td role="cell">07 Oct, 2019</td>
                                    <td role="cell">$400</td>
                                    <td role="cell"><span
                                            class="font-size-11 badge-soft-success badge bg-secondary">Paid</span>
                                    </td>
                                    <td role="cell"><span><i
                                                class="fab fa-cc-mastercard me-1"></i>
                                            Mastercard</span></td>
                                    <td role="cell"><button type="button"
                                            class="btn-sm btn-rounded btn btn-primary">View
                                            Details</button></td>
                                </tr>
                                <tr>
                                    <td role="cell"><input type="checkbox"
                                            class="form-check-input"></td>
                                    <td role="cell"><a class="text-body fw-bold"
                                            href="/dashboard">#SK2541</a></td>
                                    <td role="cell">Jamal Burnett</td>
                                    <td role="cell">07 Oct, 2019</td>
                                    <td role="cell">$380</td>
                                    <td role="cell"><span
                                            class="font-size-11 badge-soft-danger badge bg-secondary">Chargeback</span>
                                    </td>
                                    <td role="cell"><span><i class="fab fa-cc-visa me-1"></i>
                                            Visa</span></td>
                                    <td role="cell"><button type="button"
                                            class="btn-sm btn-rounded btn btn-primary">View
                                            Details</button></td>
                                </tr>
                                <tr>
                                    <td role="cell"><input type="checkbox"
                                            class="form-check-input"></td>
                                    <td role="cell"><a class="text-body fw-bold"
                                            href="/dashboard">#SK2542</a></td>
                                    <td role="cell">Juan Mitchell</td>
                                    <td role="cell">06 Oct, 2019</td>
                                    <td role="cell">$384</td>
                                    <td role="cell"><span
                                            class="font-size-11 badge-soft-success badge bg-secondary">Paid</span>
                                    </td>
                                    <td role="cell"><span><i
                                                class="fab fa-cc-paypal me-1"></i> Paypal</span>
                                    </td>
                                    <td role="cell"><button type="button"
                                            class="btn-sm btn-rounded btn btn-primary">View
                                            Details</button></td>
                                </tr>
                                <tr>
                                    <td role="cell"><input type="checkbox"
                                            class="form-check-input"></td>
                                    <td role="cell"><a class="text-body fw-bold"
                                            href="/dashboard">#SK2543</a></td>
                                    <td role="cell">Barry Dick</td>
                                    <td role="cell">05 Oct, 2019</td>
                                    <td role="cell">$412</td>
                                    <td role="cell"><span
                                            class="font-size-11 badge-soft-success badge bg-secondary">Paid</span>
                                    </td>
                                    <td role="cell"><span><i
                                                class="fab fa-cc-mastercard me-1"></i>
                                            Mastercard</span></td>
                                    <td role="cell"><button type="button"
                                            class="btn-sm btn-rounded btn btn-primary">View
                                            Details</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="justify-content-between align-items-center row">
                        <div>
                            <ul class="pagination pagination-rounded justify-content-end mb-2">
                                <li class="page-item disabled"><a class="page-link"
                                        href="/dashboard"><i
                                            class="mdi mdi-chevron-left"></i></a></li>
                                <li class="page-item active"><a class="page-link"
                                        href="/dashboard">1</a></li>
                                <li class="page-item"><a class="page-link"
                                        href="/dashboard">2</a></li>
                                <li class="page-item "><a class="page-link"
                                        href="/dashboard"><i
                                            class="mdi mdi-chevron-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
