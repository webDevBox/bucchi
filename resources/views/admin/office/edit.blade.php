@extends('layouts.app')
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
                        <form method="POST" action="{{ route('updateOffice',['id' => $office->id]) }}">
                            @csrf
                            <div class="form-group">
                                <Label for="client_name">Name</Label>
                                <input type="text" value="{{ $office->name }}" name="name" id="client_name"
                                    class="form-control" placeholder="Enter Officer Name..." required>
                            </div>
                            <div class="form-group">
                                <Label for="client_email">Email</Label>
                                <input type="email" name="email" value="{{ $office->email }}" id="client_email"
                                    class="form-control" placeholder="Enter Officer Email..." required>
                            </div>
                            <hr>
                            <h3 class="text-center">Permissions</h3>
                            <input type="checkbox" id="client_permission" name="client_permission" value="1" @if($office->permission->client == 1) checked @endif>
                            <label for="client_permission">Client</label><br>

                            <input type="checkbox" id="production_permission" name="production_permission" value="1"
                            @if($office->permission->production == 1) checked @endif>
                            <label for="production_permission">Production</label><br>

                            <input type="checkbox" id="search_permission" name="search_permission" value="1" @if($office->permission->search == 1) checked @endif>
                            <label for="search_permission">Search</label><br>

                            <input type="checkbox" id="petty_permission" name="cash_permission" value="1" @if($office->permission->petty == 1) checked @endif>
                            <label for="petty_permission">Petty Cash</label>
                            <button class="btn btn-primary d-block mx-auto">Update</button>
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