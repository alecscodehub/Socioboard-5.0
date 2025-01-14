@php
    $content = '';
    $content .= isset($mediaData) && isset($mediaData['title']) ? $mediaData['title'].' ' : '';
    $content .= isset($mediaData) && isset($mediaData['description']) ? $mediaData['description'] : '';
@endphp
<!-- begin::Re-socio-->
<div class="modal fade" id="resocioModal" tabindex="-1" role="dialog" aria-labelledby="resocioModalLabel" aria-hidden="true">
    <link rel="stylesheet"  type="text/css" href="assets/plugins/custom/emojionearea/css/emojionearea.min.css" />
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resocioModalLabel">Re-Socio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form action="{{ route('publish_content.share') }}" id="publishContentForm" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <textarea class="form-control border border-light h-auto py-4 rounded-lg font-size-h6" id="normal_post_area" name="content" rows="3" placeholder="Write something !" >{!! $content !!}</textarea>
                        <span id="error-content" class="error-message form-text text-danger"></span>
                    </div>
                    <div class="form-group">
                        <div class="input-icon">
                            <input class="form-control form-control-solid h-auto py-4 rounded-lg font-size-h6" id="outgoing_url" type="text" name="outgoingUrl" autocomplete="off" placeholder="Enter Outgoing Url"
                                   value="{!! isset($mediaData) && isset($mediaData['sourceUrl']) ? $mediaData['sourceUrl'] : null !!}" />
                            <span><i class="fas fa-link"></i></span>
                        </div>
                        <span id="error-outgoingUrl" class="error-message form-text text-danger"></span>
                    </div>

                    <!-- image and video upload -->
                    <div class="row">
                        <div class="col-12" id="">
                            <ul id="media-list" class="clearfix">
                                @if(isset($mediaData['isType']) && $mediaData['isType'] !== 'no media')
                                <li>
                                    @if(isset($mediaData['type']) && $mediaData['type'] == 'image')
                                        @if(isset($mediaData) && isset($mediaData['mediaUrl']))
                                            <img src="{!! $mediaData['mediaUrl'] !!}" style="object-fit: contain;" />
                                        @else
                                            <img src="{{asset('/media/svg/illustrations/dashboard-boy.svg') }}" style="object-fit: contain;" />
                                        @endif
                                    @elseif(isset($mediaData['type']) && $mediaData['type'] == 'video')
                                    <video  autoplay controls style="object-fit: contain;">
                                        <source src="{{$mediaData['mediaUrl']}}">
                                    </video>
                                @endif
                                <!-- sample code for video added -->
                                        <div class="thumb-count"></div>
                                </li>
                                @endif
                                <li class="myupload">
                                  <span>
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                        @if(isset($mediaData['type']) && $mediaData['type'] == 'image')
                                          <input type="file" click-type="type2" id="picupload" class="picupload"
                                                 name="file[]" multiple accept=".jpg, .png, .jpeg" style="width: 100px"
                                                 title="Click to Add File"/>
                                      @elseif(isset($mediaData['type']) && $mediaData['type'] == 'video')
                                          <input type="file" click-type="type2" id="picupload" class="picupload"
                                                 name="file[]" multiple accept="video/*" style="width: 100px"
                                                 title="Click to Add File"/>
                                      @else
                                          <input type="file" click-type="type2" id="picupload" class="picupload"
                                                 name="file[]" multiple accept="video/*,.jpg, .png, .jpeg"
                                                 style="width: 100px" title="Click to Add File"/>
                                      @endif
                                      @if(isset($mediaData['type']) && $mediaData['type'] == 'image')
                                          <input type="hidden" name="mediaUrl" id="media_url"
                                                 value="{!! isset($mediaData) && isset($mediaData['mediaUrl']) ? $mediaData['mediaUrl'] : null !!}">
                                      @else
                                          <input type="hidden" name="mediaUrl" id="media_url"
                                                 value="{!! isset($mediaData) && isset($mediaData['mediaUrl']) ? $mediaData['mediaUrl'] : null !!}">
                                      @endif

                                  </span>
                                </li>
                            </ul>
                            <span id="error-file" class="error-message form-text text-danger"></span>
                        </div>
                    </div>
                    <!-- end of image and video upload -->
                @if(isset($socialAccounts) && !empty($socialAccounts))
                    <!-- begin:Accounts list -->
                            <ul class="nav justify-content-center nav-pills" id="AddAccountsTab" role="tablist">
                                @foreach($socialAccounts as $key => $socialAccount)
                                        <li class="nav-item">
                                            <a class="nav-link" id="{{$key}}-tab-accounts" data-toggle="tab" href="#{{$key}}-add-accounts">
                                                <span class="nav-text"><i class="fab fa-{{$key}} fa-2x"></i></span>
                                            </a>
                                        </li>
                                @endforeach
                            </ul>
                            <span id="error-socialAccount" class="error-message form-text text-danger text-center"></span>
                            <div class="tab-content mt-5" id="AddAccountsTabContent">
                                @foreach($socialAccounts as $key => $socialAccountsGroups)
                                    <div class="tab-pane" id="{{$key}}-add-accounts" role="tabpanel" aria-labelledby="{{$key}}-tab-accounts">
                                        <div class="mt-3">
                                            <div class="scroll scroll-pull" data-scroll="true" data-wheel-propagation="true" style="height: 180px;overflow-y: scroll;">
                                                @foreach($socialAccountsGroups as $group => $socialAccountArray)
                                                    @if(($group === "account") || ($group === "page") || ($group === "business account"))
                                                        @if(ucwords($key) === "Twitter")
                                                            <ul class="schedule-social-tabs">
                                                                <li class="font-size-md font-weight-normal">Character limit is 280.</li>
                                                                <li class="font-size-md font-weight-normal">You can post max 4 images at a time.</li>
                                                            </ul>
                                                        @elseif(ucwords($key) === "Facebook")
                                                            <ul class="schedule-social-tabs">
                                                                <li class="font-size-md font-weight-normal">Character limit is 5000.</li>
                                                                <li class="font-size-md font-weight-normal">You can post max 4 images at a time.</li>
                                                            </ul>
                                                        @elseif(ucwords($key) === "Instagram")
                                                            <ul class="schedule-social-tabs">
                                                                <li class="font-size-md font-weight-normal">Character limit is 2200.</li>
                                                                <li class="font-size-md font-weight-normal">You can post max 1 image or 1 video at a time.</li>
                                                                <li class="font-size-md font-weight-normal">Image or video for posting is required.</li>
                                                            </ul>
                                                        @elseif(ucwords($key) === "Linkedin")
                                                            <ul class="schedule-social-tabs">
                                                                <li class="font-size-md font-weight-normal">Character limit is 700.</li>
                                                                <li class="font-size-md font-weight-normal">You can post max 1 image or 1 video at a time.</li>
                                                            </ul>
                                                        @elseif(ucwords($key) === "Tumblr")
                                                            <ul class="schedule-social-tabs">
                                                                <li class="font-size-md font-weight-normal">You can post max 1 image or 1 video at a time.</li>
                                                                <li class="font-size-md font-weight-normal">Media size should be less than 10MB .</li>
                                                            </ul>
                                                        @endif
                                                        <span>Choose {{ucwords($key)}} {{$group}} for posting </span>
                                                        @foreach($socialAccountArray as $group_key => $socialAccount)
                                                            @if($socialAccount->join_table_teams_social_accounts->is_account_locked == false)
                                                            <!--begin::Page-->
                                                                <div class="d-flex align-items-center flex-grow-1">
                                                                    <!--begin::Facebook Fanpage Profile picture-->
                                                                    <div class="symbol symbol-45 symbol-light mr-5">
                                                                    <span class="symbol-label">
                                                                        <img src="{{isset($socialAccount->profile_pic_url) ?  $socialAccount->profile_pic_url : null}}" class="w-100 align-self-center" alt=""/>
                                                                    </span>
                                                                    </div>
                                                                    <!--end::Facebook Fanpage Profile picture-->
                                                                    <!--begin::Section-->
                                                                    <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                                                        <!--begin::Info-->
                                                                        <div class="d-flex flex-column align-items-cente py-2 w-75">
                                                                            <!--begin::Title-->
                                                                            <a href="javascript:;" class="font-weight-bold text-hover-primary font-size-lg mb-1">
                                                                                {{ $socialAccount->first_name.' '. $socialAccount->last_name }}
                                                                            </a>
                                                                            <!--end::Title-->

                                                                            <!--begin::Data-->
                                                                            <span class="text-muted font-weight-bold">
                                                                            {{-- 2M followers --}}
                                                                                {{ $socialAccount->friendship_counts }} followers
                                                                        </span>
                                                                            <!--end::Data-->
                                                                        </div>
                                                                        <!--end::Info-->
                                                                    </div>
                                                                    <!--end::Section-->
                                                                    <!--begin::Checkbox-->
                                                                    <label class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">
                                                                        <input type="checkbox" name="socialAccount[]" value="{{ $socialAccount->account_id }}"/>
                                                                        {{-- <input type="hidden" name="account_id[{{ $socialAccount->account_id }}]" value="{{ $socialAccount->account_id }}"> --}}
                                                                        <span></span>
                                                                    </label>
                                                                    <!--end::Checkbox-->
                                                                </div>
                                                                <!--end::Page-->
                                                                @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        <!-- end:Accounts list -->
                    @endif
                </div>

                <div class="modal-footer">
                    <button type="button" name="status" value="0" class="publishContentSubmit btn font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3 ">Draft</button>
                    <button type="button" name="status" value="1" class="publishContentSubmit btn font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3 ">Post</button>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- end::Re-socio-->