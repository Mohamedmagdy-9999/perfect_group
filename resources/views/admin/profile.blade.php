@extends('admin.layout')
@section('content')
		

              

                <!--app-content open-->
                <div class="app-content main-content mt-0">
                    <div class="side-app">

                        <!-- CONTAINER -->
                        <div class="main-container container-fluid">

                                
                            <!-- PAGE-HEADER -->
                            <div class="page-header">
                                <div>
                                    <h1 class="page-title">{{trans('main.dashboard')}}</h1>
                                </div>
                                <div class="ms-auto pageheader-btn">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">{{trans('main.profile')}}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{trans('main.dashboard')}}</li>
                                    </ol>
                                </div>
                            </div>
                            <!-- PAGE-HEADER END -->

                            <!-- ROW-1 -->
                            <form action="{{route('update_profile', auth()->user()->id)}}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-3">{{trans('main.name')}}</label>
                                    <div class="col-9">
                                        <input type="text" id="name" class="form-control" name="name" value="{{auth()->user()->name}}">
                                        @error('name')
                                            <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
            
                                <div class="form-group row">
                                    <label for="name" class="col-3">{{trans('main.email')}}</label>
                                    <div class="col-9">
                                        <input type="email" id="email" class="form-control" name="email" value="{{auth()->user()->email}}">
                                        @error('email')
                                            <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
            
                                <div class="form-group row">
                                    <label for="name" class="col-3">{{trans('main.password')}}</label>
                                    <div class="col-9">
                                        <input type="password" id="password" class="form-control" name="password" >
                                        @error('password')
                                            <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
            
                               
                            
            
                                <div class="form-group row">
                                    <label for="" class="col-3"></label>
                                    <div class="col-9">
                                        <button type="submit" class="btn btn-sm btn-primary">update</button>
                                    </div>
                                </div>
                            </form>
                          

                            
                        </div>
                    </div>
                </div>
                    <!-- CONTAINER CLOSED -->
            
@endsection
         

            
		

        
      
