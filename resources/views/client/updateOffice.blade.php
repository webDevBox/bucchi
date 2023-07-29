@extends('layouts.office')
@section('style')
<style>
    .loader {
        width: 32px;
        height: 32px;
        position: relative;
        border-radius: 50%;
        color: #FF3D00;
        display: block;
        animation: fill 1s ease-in infinite alternate;
    }

    .loader::before,
    .loader::after {
        content: '';
        position: absolute;
        height: 100%;
        width: 100%;
        border-radius: 50%;
        left: 48px;
        top: 0;
        animation: fill 0.9s ease-in infinite alternate;
    }

    .loader::after {
        left: auto;
        right: 48px;
        animation-duration: 1.1s;
    }

    @keyframes fill {
        0% {
            box-shadow: 0 0 0 2px inset
        }

        100% {
            box-shadow: 0 0 0 10px inset
        }
    }
</style>
@endsection
@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="dashboard-ecommerce">
                <div class="row bg-white p-2 match-height">
                    <div class="col-md-6 offset-md-3 col-sm-12">
                        <form method="POST" action="{{ route('updateClient',['id' => $client->id]) }}">
                            @csrf
                            <div class="form-group">
                                <Label for="client_name">Client Name</Label>
                                <input value="{{ $client->name }}" name="name" type="text" id="client_name"
                                    class="form-control" placeholder="Enter Client Name..." required>
                            </div>
                            <div class="form-group">
                                <Label for="client_contact">Client Contact</Label>
                                <input value="{{ $client->contact }}" name="contact" type="number" id="client_contact"
                                    class="form-control" placeholder="Enter Client Contact...">
                            </div>
                            <div class="form-group">
                                <Label for="client_email">Client Email</Label>
                                <input value="{{ $client->email }}" name="email" type="email" id="client_email"
                                    class="form-control" placeholder="Enter Client Email...">
                            </div>
                            <div class="form-group">
                                <Label for="client_country">Client Country</Label>
                                <input value="{{ $client->country }}" name="country" type="text" id="client_country"
                                    class="form-control" placeholder="Enter Client Country Name...">
                            </div>
                                <button type="submit" class="d-block mx-auto btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection