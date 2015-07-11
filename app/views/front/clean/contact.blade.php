@extends('front.marketing.tpl.main')

@section('body')
	<section class="wrap" id="page">
		<div class="col-md-8">
			<h2>Contact</h2> <hr />
			<div class="content">
				    @if($errors->all())
				        <ul class="list-unstyled">
				            @foreach($errors->all() as $error)
				                <li class="alert alert-danger">
				                    <button type="button" class="close" data-dismiss="alert">&times;</button>
				                    {{ $error }}
				                </li>
				            @endforeach
				        </ul>
				    @endif

				    @if(Session::get('success'))
				        <p class="alert alert-success">
				            <button type="button" class="close" data-dismiss="alert">&times;</button>
				            {{ Session::get('success') }}
				        </p>
				    @elseif(Session::get('error'))
				        <p class="alert alert-danger">
				            <button type="button" class="close" data-dismiss="alert">&times;</button>
				            {{ Session::get('error') }}
				        </p>
				    @endif

				{{ Form::open(array('url' => Request::path(), 'role' => 'form', 'class' => 'form')) }}
					<div class="form-group">
						<label class="control-label" for="name">Name <sup class="text text-error">*</sup></label>
						<div class="controls">
							<input name="name" type="text" id="name" class="form-control" placeholder="Name" value="{{ Input::old('name')}}">
						</div>
					</div>						
					<div class="form-group">
						<label class="control-label" for="email">Email <sup class="text text-error">*</sup></label>
						<div class="controls">
							<input name="email" type="email" id="email" class="form-control" placeholder="Email" value="{{ Input::old('email')}}">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label" for="contact">Contact #</label>
						<div class="controls">
							<input name="contact" type="text" id="contact" class="form-control" placeholder="contact" value="{{ Input::old('contact')}}">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label" for="message">Message <sup class="text text-error">*</sup></label>
						<div class="controls">
							<textarea name="message" id="message" class="form-control" placeholder="Message" rows="5">{{ Input::old('message')}}</textarea>
							<br /> <br /> <button class="btn btn-primary" type="submit" name="submit">Submit</button>
						</div>
					</div>
				{{ Form::close() }}
			</div>
		</div>
		<aside class="col-md-4">
			<div class="sidebar archives">
				<h2>Search</h2>
				{{ Form::open(array('url' => 'search', 'role'=>'form', 'class' => 'form-horizontal', 'method' => 'get')) }}
				<div class="form-group">
					<div class="input-group">
						<input type="text" class="form-control" name="term" value="" placeholder="Search now">
						<div class="input-group-addon"><i id="btn_search" class="glyphicon glyphicon-search"></i></div>
					</div>
				</div>					
				{{ Form::close() }}
			</div>				
			<div class="sidebar archives">
				<h2>Archives</h2>
				<ul>
					<li><a href="#">January</a></li>
					<li><a href="#">February</a></li>
					<li><a href="#">March</a></li>
				</ul>
			</div>
		</aside>
	</section>
@stop