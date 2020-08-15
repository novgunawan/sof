@extends('master')

@section('title', 'Profil')

@section('content')
	<div class="col-md-3 mx-auto">
		<div class="card card-primary card-outline">
	    	<div class="card-body box-profile">
	            <div class="text-center">
	              	<img class="profile-user-img img-fluid img-circle" src="{{ asset('/adminlte/dist/img/user4-128x128.jpg')}}" alt="User profile picture">
	            </div>
	            <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
	            <p class="text-muted text-center">{{ Auth::user()->email }}</p>
	            <ul class="list-group list-group-unbordered mb-3">
	                <li class="list-group-item">
	                	<b>Poin Reputasi</b> <a class="float-right">500</a>
	                </li>
	                <li class="list-group-item">
	                    <b>Pertanyaan</b> <a class="float-right">12</a>
	                </li>
	                <li class="list-group-item">
	                    <b>Jawaban</b> <a class="float-right">35</a>
	                </li>
	            </ul>
	            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
	        </div>
	    </div>
	</div>
@endsection