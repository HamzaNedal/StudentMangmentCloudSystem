@extends('layouts.app')

@section('style')
<style type="text/css">
.desabled {
	pointer-events: none;
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
    	<div class="col-md-4">
    		<div class="card card-default">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <strong>Add Course</strong>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form id="addCourse" class="" method="POST" action="">
                            <label for="course_id" class="col-md-12 col-form-label">Course ID</label>

                            <div class="col-md-12">
                                <input id="course_id" type="text" class="form-control" name="course_id" value="" required >
                            </div>
                            <label for="name" class="col-md-12 col-form-label">Name Course</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="name" value="" required >
                            </div>

                            <label for="hour" class="col-md-12 col-form-label">Number Of Hours</label>

                            <div class="col-md-12">
                                <input id="hour" type="text" class="form-control" name="hour" value="" required >
                            </div>

                            <label for="sem" class="col-md-12 col-form-label">Semester</label>

                            <div class="col-md-12">
                                <select class="custom-select" id="sem">
                                    <option selected>Choose option</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                  </select>
                            </div><br>
                                <div class="col-md-12 col-md-offset-3">
                                    <button type="button" class="btn btn-primary btn-block desabled" id="submitUser">Submit</button>

                                </div>

                    </form>
                </div>
            </div>
    	</div>
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <strong>All Course Listing</strong>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Hours</th>
                            <th>Semeseter</th>
                            {{-- <th width="180" class="text-center">Action</th> --}}
                        </tr>
                        <tbody id="tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Update Model -->
{{-- <form action="" method="POST" class="users-update-record-model form-horizontal">
    <div id="update-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content" style="overflow: hidden;">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Update Record</h4>
                    <button type="button" class="close update-data-from-delete-form" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" id="updateBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect update-data-from-delete-form" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success waves-effect waves-light updateUserRecord">Update</button>
                </div>
            </div>
        </div>
    </div>
</form> --}}


@endsection


@section('script')
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-firestore.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>



var firebaseConfig = {
   apiKey: "AIzaSyC6anjgGkdu1ZmOQ3iqubw53ITRF05hdUM",
   authDomain: "projectcloud-243cc.firebaseapp.com",
   databaseURL: "https://projectcloud-243cc.firebaseio.com",
   projectId: "projectcloud-243cc",
   storageBucket: "projectcloud-243cc.appspot.com",
   messagingSenderId: "342012000826",
   appId: "1:342012000826:web:53ddd3195cd75847d19303",
   measurementId: "G-72HXE052RN"
};
firebase.initializeApp(firebaseConfig);
  var database = firebase.firestore();
  var size = 0;
//getData
database.collection('Course').get().then(snap => {
   size = snap.size // will return the collection size
   var htmls = [];
   snap.docs.forEach(doc=>{
    doc = doc.data();
    htmls.push('<tr>\
         		<td>'+ doc.id_course +'</td>\
         		<td>'+ doc.name +'</td>\
         		<td>'+ doc.hours +'</td>\
         		<td>'+ doc.semester +'</td>\
        	</tr>');
    $('#tbody').html(htmls);
/*<td><a data-toggle="modal" data-target="#update-modal" class="btn btn-outline-success updateData" data-id="'+id+'">Update</a>\
         		<a data-toggle="modal" data-target="#remove-modal" class="btn btn-outline-danger removeData" data-id="'+id+'">Delete</a></td>\*/
   });

});


// Add Data
$(document).on('click', '#submitUser', function(){
    //console.log("test");

    var lastIndex = size;
	var values = $("#addCourse").serializeArray();

	var id_course = values[0].value;
	var name = values[1].value;
	var hours = values[2].value;
	var sem = $('#sem').val();
	var userID = lastIndex+1;
 //   const docRef = database.collection('iug').doc('student');
 database.collection('Course').doc(id_course).set({
        id_course: id_course,
        name: name,
        hours: hours,
        semester: sem,
     }).then(function () {
        console.log('database updated');
     }).catch(function (err) {
         console.log(err)
     });

    lastIndex = userID;
	$("#addUser input").val("");
});



</script>

@endsection
