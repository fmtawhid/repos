 <!-- Table start -->
 <div class="card mb-4" id="paymentDetailDiv">
     <div class="card-body">
         <table class="table table-bordered">
             <tbody>
                 @if ($history->payment_status)
                     <tr>
                         <th>{{ localize('Payment status') }}</th>
                         <td> <span
                                 class="badge  rounded-pill text-capitalize {{ getStatusColor($history->payment_status, 'payment') }}">
                                 {{ getSubscriptionPaymentStatusName($history->payment_status) }}</span>
                         </td>
                     </tr>
                 @endif
                 @if ($history->subscription_status)
                     <tr>
                         <th>{{ localize('Subscription status') }}</th>
                         <td> <span
                                 class="badge  rounded-pill text-capitalize {{ getStatusColor($history->subscription_status, 'subscription') }}">
                                 {{ getSubscriptionStatusName($history->subscription_status) }}</span>
                         </td>
                     </tr>
                 @endif
                 <tr>
                     <th>{{ localize('Payment Method') }}</th>
                     <td>{{ $history->offlinePaymentMethod->name }}</td>
                 </tr>
                 <tr>
                     <th>{{ localize('Paid Amount') }}</th>
                     <td>{{ $history->price }}</td>
                 </tr>
                 <tr>
                     <th>{{ localize('Payment Details') }}</th>
                     <td>
                         {{ $history->payment_details ? json_decode($history->payment_details) : localize('No details available') }}
                     </td>
                 </tr>
                 <tr>
                     <th>{{ localize('Payment Note') }}</th>
                     <td>{{ $history->note }}</td>
                 </tr>
                 @if ($history->file)
                     <tr>
                         <th>{{ localize('File') }}</th>
                         <td>
                             <img src="{{ asset($history->file) }}" alt="" class="img-fluid">
                         </td>
                     </tr>
                 @endif
             </tbody>
         </table>
     </div>
 </div>
 <!-- Table end -->
 @if (isCustomerUserGroup())
     <div class="card mb-4" id="reSubmitDiv">
         <form action="" method="POST" class="pb-650" enctype="multipart/form-data">
             @csrf
             <input type="hidden" name="history_id" value="{{ $history->id }}">
             <!--basic information start-->

             <div class="card-body">
                 <h5 class="mb-4">{{ localize('Admin Required') }} <span class="text-danger ms-1">*</span>
                 </h5>
                 <p>[ {{ $history->feedback_note }} ]</p>
                 <hr class="mb-4">
                 <div class="offline_payment " id="offline_payment">
                     <div class="mb-4">
                         <label for="payment_method" class="form-label">{{ localize('Payment Method') }}
                             <span class="text-danger ms-1">*</span></label>
                         <select class="form-control select2" id="offline_payment_method" name="offline_payment_method"
                             data-toggle="select2">
                             <option value="">{{ localize('Select Offline Payment Method') }}
                             </option>
                             @foreach ($offlinePaymentMethods as $offlinePaymentMethod)
                                 <option value="{{ $offlinePaymentMethod->id }}"
                                     {{ $history->offline_payment_id == $offlinePaymentMethod->id ? 'selected' : '' }}>
                                     {{ $offlinePaymentMethod->name }}</option>
                             @endforeach
                         </select>
                     </div>

                     <div class="mb-4">
                         <label for="name" class="form-label text-center">{{ localize('Description') }}
                             <span class="text-danger ms-1">*</span></label>
                         @foreach ($offlinePaymentMethods as $offlinePaymentMethod)
                             <p id="description_{{ $offlinePaymentMethod->id }}" class="all-description d-none">
                                 {{ $offlinePaymentMethod->description }}</p>
                         @endforeach
                     </div>

                     <div class="mb-4">
                         <label class="form-label">{{ localize('Payment Details') }} <span
                                 class="text-danger ms-1">*</span></label>
                         <textarea class="form-control" name="payment_detail" id="offline_payment_detail" rows="2"
                             placeholder="{{ localize('Type your Payment Details') }}">{{ $history->payment_details ? json_decode($history->payment_details) : null }}</textarea>
                         @if ($errors->has('payment_detail'))
                             <span class="text-danger">{{ $errors->first('payment_detail') }}</span>
                         @endif
                     </div>
                     <div class="mb-4">
                         <label class="form-label">{{ localize('Note') }}</label>
                         <textarea class="form-control" name="note" id="offline_note" rows="1"
                             placeholder="{{ localize('Type your Note') }}">{{ $history->note }}</textarea>
                         @if ($errors->has('note'))
                             <span class="text-danger">{{ $errors->first('note') }}</span>
                         @endif
                     </div>
                     <div class="mb-3">
                         <label for="default_creativity" class="form-label">{{ localize('File') }}
                         </label>
                         <br>
                         @if ($history->file)
                             <img src="{{ asset($history->file) }}" alt="" class="mb-2 img-fluid">
                         @endif
                         <div class="file-drop-area file-upload text-center rounded-3">
                             <input type="file" class="file-drop-input" name="file" id="offline_file" />
                             <div class="file-drop-icon ci-cloud-upload">
                                 <i data-feather="image"></i>
                             </div>
                             <p class="text-dark fw-bold mb-2 mt-3">
                                 {{ localize('Drop your files here or') }}
                                 <a href="javascript::void(0);" class="text-primary">{{ localize('Browse') }}</a>
                             </p>
                             <p class="mb-0 file-name text-muted">

                                 <small>* {{ localize('Allowed file types: jpg,png,jpeg') }}
                                 </small>


                             </p>
                         </div>
                         @if ($errors->has('file'))
                             <span class="text-danger">{{ $errors->first('file') }}</span>
                         @endif
                     </div>

                 </div>
             </div>
             <!--basic information end-->


             <!-- submit button -->
             <div class="row">
                 <div class="col-12">
                     <div class="mb-4">
                         <button class="btn btn-primary" type="submit">
                             <i data-feather="save" class="me-1"></i> {{ localize('Update') }}
                         </button>
                     </div>
                 </div>
             </div>
             <!-- submit button end -->

         </form>
     </div>
 @endif
 <div class="card mb-4 d-none" id="feedbackBack">
     <div class="card-body">
         <form action="">
             <div class="mb-3">
                 <x-form.label for="payment_detail" label="{{ localize('Feedback') }}" isRequired=true />
                 <x-form.textarea name="payment_detail" id="payment_detail" type="text"
                     placeholder="{{ localize('Feedback') }}" value="" showDiv=false />
             </div>
             <div class="mb-3">
                 <x-form.button id="addUserBtn">{{ localize('Save') }}</x-form.button>
             </div>

         </form>
     </div>
 </div>
