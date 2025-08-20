@extends('layouts.default')

@section('title')
    {{ localize('Tickets') }}
@endsection

@section('breadcrumb')
    @php
    $breadcrumbItems = [['href' => null, 'title' => $ticket->title]]; @endphp
    <x-common.breadcumb :items="$breadcrumbItems" />
@endsection


@section('content')
<section class="tt-section pt-4">
    <div class="container">
    

        <div class="row g-4">
            <!--left sidebar-->
            <div class="col-xl-12 order-2 order-md-2 order-lg-2 order-xl-1">
           
                    <div class="row">
                        <div class="col-xl-8 order-1 order-md-1 order-lg-1 order-xl-2">
                            <div class="mb-3">
                                <p>{!! $ticket->description !!}</p>
                            </div>
                            <div class="mb-3">
                                @foreach ($ticket->images as $item)
                                    <img src="{{asset($item->file_path)}}" alt="">
                                @endforeach
                            </div>
                            <div class="mb-3">
                                @foreach ($ticket->replies as $item)
                                <div class="reply-body">
                                    <div class="user-pic-time">
                                        <div class="reply-profile avatar avatar-md">
                                            <img class="rounded-circle" src="{{ uploadedAsset($item->user->avatar) }}" alt="avatar" onerror="this.onerror=null;this.src='{{ staticAsset('/backend/assets/img/avatar/1.jpg') }}';">
                                            
                                        </div>
                                        <div class="time">
                                            {{date('d-M-y h:i:s A', strtotime($item->created_at))}}
                                        </div>
                                    </div>
                                   
                                    <div class="reply-content">
                                        <p> {!! $item->replied !!}</p>
                                        
                                    </div>
                                </div>
                                 
                                @endforeach
                            </div>
                                                      
                        </div>
                        <div class="col-xl-4 order-1 order-md-1 order-lg-1 order-xl-2">
                                <table class="table boder-1">
                                    <tbody>
                                        <tr>
                                            <td>{{localize('Ticket ID')}}</td>
                                            <td>#{{$ticket->id}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{localize('Ttile')}}</td>
                                            <td>{{$ticket->title}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{localize('Created By')}}</td>
                                            <td> {{$ticket->createdBy->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{localize('Created At')}}</td>
                                            <td>{{date('d-M-y h:i:s A', strtotime($ticket->created_at))}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{localize('Status')}} </td>
                                        
                                            <td> {{$ticket->is_active == 1 ? 'active':'closed'}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{localize('Assigned Staffs')}}</td>
                                            <td> 
                                                @if($ticket->assigStaffs)
                                                    @foreach ($ticket->assigStaffs as $staff)
                                                        {{$staff->name}}
                                                        {{ $name = $loop->first || $loop->last ? '' : ','}}
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                        </div>
                        
                    </div>
                  
            </div>

        </div>
    </div>
</section>
@endsection
