@extends('layouts.app')
@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Songs</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">songs
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <div class="dropdown">
                            <a href="{{ url('admin/songs/create') }}" class="btn-icon btn btn-primary btn-round btn-sm" type="button" title="" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Add new song">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatables-basic table" id="datatables">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Categories Name</th>
                                            <th>Singer Name</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Duration</th>
                                            <th>Banner Image</th>
                                            <th>Attachment</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($songs))
                                            @foreach($songs as $k => $song)
                                            @php 
                                            //banner image
                                            if ($song->banner_image != '') 
                                            {
                                                $deldestinationPath =  Storage::disk('public')->path('uploads/song_banner_images');
                                                if(File::exists($deldestinationPath.'/'.$song->banner_image)) {
                                                    $banner_image = url('storage/app/public/uploads/song_banner_images/'.$song->banner_image);
                                                }
                                                else
                                                {
                                                    $banner_image = "";
                                                }
                                            }
                                            else
                                            {
                                                $banner_image = "";
                                            }

                                            // song file
                                            if ($song->attachment != '') 
                                            {
                                               $delddestinationPath =  Storage::disk('public')->path('uploads/songs');
                                                if(File::exists($delddestinationPath.'/'.$song->attachment)) {
                                                    $attachment = url('storage/app/public/uploads/songs/'.$song->attachment);
                                                }
                                                else
                                                {
                                                    $attachment = "";
                                                }
                                            }
                                            else
                                            {
                                                $attachment = "";
                                            }
                                            @endphp
                                            <tr>
                                                <td>{{ $k+1 }}</td>
                                                <td>{{ $song->categories_name }}</td>
                                                <td>{{ $song->singer_name }}</td>
                                                <td>{{ $song->name }}</td>
                                                <td>{{ $song->description }}</td>
                                                <td>{{ $song->duration }}</td>
                                                <td><a href="{{ $banner_image }}" target="_blank">{{ $song->banner_image }}</a></td>
                                                <td><a href="{{ $attachment }}" target="_blank">{{ $song->attachment }}</a></td>
                                                <td>
                                                    @if($song->status == 1)
                                                        <span class="badge rounded-pill badge-light-success me-1">Active</span>
                                                    @else
                                                        <span class="badge rounded-pill badge-light-danger me-1">Deactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                                            @if($song->status == 1)
                                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#status-model" data-id="{{ $song->id }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock me-50"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                                                <span>Status</span>
                                                            </a>
                                                            @else
                                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#status-model" data-id="{{ $song->id }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-unlock me-50"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 9.9-1"></path></svg>
                                                                <span>Status</span>
                                                            </a>
                                                            @endif
                                                            <a class="dropdown-item" href="{{ route('songs.edit',array($song->id)) }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 me-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                                <span>Edit</span>
                                                            </a>
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-model" data-id="{{ $song->id }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash me-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                                <span>Delete</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Basic table -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- Status Modal -->
    <div class="modal fade text-start" id="status-model" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Change song status</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form" id="status_model" action="{{ route('admin.song-status') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p>
                        Are you sure want to change this song status..?
                    </p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id">
                    <button type="button" class="btn btn-outline-primary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade text-start" id="delete-model" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Delete Song</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form" id="delete_model" action="{{ route('admin.song-delete') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p>
                        Are you sure want to delete this song..?
                    </p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id">
                    <button type="button" class="btn btn-outline-primary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
