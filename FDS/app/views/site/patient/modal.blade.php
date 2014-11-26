@section('patient')
<div class="modal fade bs-example-modal-lg" id="patient-modal" tabindex="-1" role="dialog" aria-labelledby="patient-modalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="patient-modalLabel">New message</h4>
	      	</div>
		      	<div role="tabpanel">
			       	<ul class="nav nav-tabs" role="tablist">
						@if (Auth::check())
	                        @if (Auth::user()->hasRole('admin'))
        		      			<?php $profile_active = 'active'; ?>
	    		      			<?php $note_active = ''; ?>
					    		<li role="presentation" class="{{ $profile_active }}"><a href="#tab-profile" aria-controls="tab-profile" role="tab" data-toggle="tab">Profile</a></li>
	    		      		@else
	    		      			<?php $note_active = 'active'; ?>
	    		      			<?php $profile_active = ''; ?>
	    		      		@endif

					    <li role="presentation" class="{{ $note_active }}"><a href="#tab-note" aria-controls="tab-note" role="tab" data-toggle="tab">Note</a></li>
				  	</ul>
				  	<div class="tab-content">

				  		<!-- tab Profile -->
				  		<div role="tabpanel" class="tab-pane {{ $profile_active }}" id="tab-profile">
			      			{{ Form::open( array(
							    'route' => 'patient.update',
							    'method' => 'post',
							    'id' => 'form-profile'
							) ) }}
				      		<div class="modal-body">
					         		<div class="form-group">
					            		<label for="username" class="control-label">Username:</label>
					           			<input type="text" class="form-control" id="username" name="username" readonly>
					         		</div>
					          		<div class="form-group">
					            		<label for="patient-firstname" class="control-label">First Name:</label>
					            		<input type="text" class="form-control" id="first_name" name="username" ></input>
					          		</div>
					          		<div class="form-group">
					            		<label for="patient-lastname" class="control-label">Last Name:</label>
					            		<input type="text" class="form-control" id="last_name" name="last_name"></input>
					          		</div>
				  	          		<div class="form-group">
					           		 	<label for="email" class="control-label">E-mail:</label>
					            		<input type="text" class="form-control" id="email" name="email"></input>
					          		</div>
				  	          		<div class="form-group">
					            		<label for="address" class="control-label">Address:</label>
					            		<input type="text" class="form-control" id="address" name="address"></input>
					          		</div>
				  	          		<div class="form-group">
					            		<label for="tel" class="control-label">Tel:</label>
					            		<input type="text" class="form-control" id="tel" name="tel"></input>
					          		</div>
				      		</div>
				      		<div class="modal-footer">
				        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        		<button type="submit" class="btn btn-primary" id="save_profile" name="save_profile">Save</button>
				      		</div>
				      		{{ Form::close() }}
				      		
			      		</div>
			      		@endif
	
			      		<!-- tab Note -->
			      		<div role="tabpanel" class="tab-pane {{ $note_active }}" id="tab-note">
			      			{{ Form::open( array(
							    'route' => 'patient.create',
							    'method' => 'post',
							    'id' => 'form-note'
							) ) }}
 							<div class="modal-body">
 								<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>
 									<!-- List Note -->
 								</div>
							</div>
							<div class="modal-footer">
								<div class="form-group">
									{{ Form::textarea( 'note', '', array(
									    'id' => 'note',
									    'placeholder' => 'Note..',
									    'required' => true,
									    'class' => 'form-control'
									) ) }}
					 			<!-- 	<div class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
										<div class="col-md-12">
											<textarea required="true" class="form-control full-width wysihtml5" name="content" rows="10" id="note">{{{ Input::old('content', isset($post) ? $post->content : null) }}}</textarea>
											{{{ $errors->first('content', '<span class="help-block">:message</span>') }}}
										</div>
									</div> -->

									{{ Form::submit( 'Save', array(
									    'id' => 'save_note',
									    'class' => 'btn btn-primary'
									) ) }}
									{{ Form::button( 'Cancel', array(
									    'id' => 'cancel_update',
									    'class' => 'btn btn-default',
									    'style' => 'display:none'
									) ) }}

									{{ Form::close() }}
				      			</div>
					  		</div>
					    </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('confirm')
<!-- Modal -->
<div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-modal-label" aria-hidden="true">
	{{ Form::open( array(
	    'route' => 'patient.delete',
	    'method' => 'post',
	    'id' => 'form-delete-note'
	) ) }}
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="confirm-modal-label">{{Lang::get('note/note.delete')}}</h4>
      </div>
      <div class="modal-body">
        {{Lang::get('note/note.confirm-delete')}}      
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" data-toggle="modal" >{{Lang::get('note/note.confirm')}} </button>
      </div>
    </div>
  </div>
  {{ Form::close() }}
</div>
@stop