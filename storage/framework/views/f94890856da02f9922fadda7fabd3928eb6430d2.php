<?php $__env->startSection('style'); ?>
<style type="text/css">
.desabled {
	pointer-events: none;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
    	<div class="col-md-4">
    		<div class="card card-default">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <strong>Add User</strong>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form id="addUser" class="" method="POST" action="">
                            <label for="first_name" class="col-md-12 col-form-label">First Name</label>

                            <div class="col-md-12">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="" required autofocus>
                            </div>
                            <label for="last_name" class="col-md-12 col-form-label">Last Name</label>

                            <div class="col-md-12">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="" required autofocus>
                            </div>
                            <label for="std_id" class="col-md-12 col-form-label">Student Id</label>

                            <div class="col-md-12">
                                <input id="std_id" type="text" class="form-control" name="std_id" value="" required autofocus>
                            </div>
                            <label for="email" class="col-md-12 col-form-label">Email</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="" required autofocus>
                            </div>
                            <label for="phone" class="col-md-12 col-form-label">Phone number</label>

                            <div class="col-md-12">
                                <input id="phone" type="phone" class="form-control" name="phone" value="" required autofocus>
                            </div>
                            <label for="dob" class="col-md-12 col-form-label">Date of Birth</label>

                            <div class="col-md-12">
                                <input id="dob" type="date" class="form-control" name="dob" value="" required autofocus>
                            </div>
                            <label for="level" class="col-md-12 col-form-label">Level</label>

                            <div class="col-md-12">
                                <select class="custom-select" id="level">
                                    <option selected>Choose option</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                    <option value="4">Four</option>
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
                            <strong>All Users Listing</strong>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone number</th>
                            <th>Date of Birth</th>
                            <th>Level</th>
                        </tr>
                        <tbody id="tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-firestore.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>

    // const submit = document.querySelector('#submitUser');
//     $(document).on('click', '#submitUser', function(){
//     //  var textToSend = input.value;
//     //  console.log('I am go to send : '+textToSend);
//     //  docRef.set({
//     //      name: textToSend
//     //  }).then(function () {
//     //     console.log('database updated');
//     //  }).catch(function (err) {
//     //      console.log(err)
//     //  });
//     console.log("test");
//   });
// Initialize Firebase

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
// console.log(database.collection('Student').doc().get());
database.collection('Student').get().then(snap => {
   size = snap.size // will return the collection size
   var htmls = [];
   snap.docs.forEach(doc=>{
    id = doc.id;
    doc = doc.data();
    htmls.push('<tr>\
         		<td>'+ doc.std_id +'</td>\
         		<td>'+ doc.first_name +'</td>\
         		<td>'+ doc.last_name +'</td>\
         		<td>'+ doc.email +'</td>\
         		<td>'+ doc.phone_nubmer +'</td>\
         		<td>'+ doc.dob +'</td>\
         		<td>'+ doc.level +'</td>\
        	</tr>');
            /*<td><a data-toggle="modal" data-target="#update-modal" class="btn btn-outline-success updateData" data-id="'+id+'">Update</a>\
         		<a data-toggle="modal" data-target="#remove-modal" class="btn btn-outline-danger removeData" data-id="'+id+'">Delete</a></td>\*/
    $('#tbody').html(htmls);

   });

});

// Get Data
// database.ref('Student').on('value', function(snapshot) {
//     var value = snapshot.val();
//     var htmls = [];
//     $.each(value, function(index, value){
//     	if(value) {
//     		htmls.push('<tr>\
//         		<td>'+ value.first_name +'</td>\
//         		<td>'+ value.last_name +'</td>\
//         		<td><a data-toggle="modal" data-target="#update-modal" class="btn btn-outline-success updateData" data-id="'+index+'">Update</a>\
//         		<a data-toggle="modal" data-target="#remove-modal" class="btn btn-outline-danger removeData" data-id="'+index+'">Delete</a></td>\
//         	</tr>');
//     	}
//     	lastIndex = index;
//     });
//     $('#tbody').html(htmls);
//     $("#submitUser").removeClass('desabled');
// });
// docRef.onSnapshot(function (doc) {
//         var data = doc.data();
//         output.innerHTML = "student name: "+data.name;
//      }).then(function () {
//         console.log('loaded complate');
//      }).catch(function (err) {
//          console.log(err)
//      });
// Add Data
$(document).on('click', '#submitUser', function(){
    //console.log("test");

    var lastIndex = size;
	var values = $("#addUser").serializeArray();

	var first_name = values[0].value;
	var last_name = values[1].value;
	var std_id = values[2].value;
	var email = values[3].value;
	var phone_nubmer = values[4].value;
	var dob = values[5].value;
	var level = $('#level').val();
	var userID = lastIndex+1;
 //   const docRef = database.collection('iug').doc('student');
 database.collection('Student').doc(std_id).set({
        first_name: first_name,
        last_name: last_name,
        std_id: std_id,
        email: email,
        phone_nubmer: phone_nubmer,
        dob: dob,
        level: level,
     }).then(function () {
        console.log('database updated');
     }).catch(function (err) {
         console.log(err)
     });

    // Reassign lastID value
    lastIndex = userID;
	$("#addUser input").val("");
});

// // Update Data
// var updateID = 0;
// $('body').on('click', '.updateData', function() {
// 	updateID = $(this).attr('data-id');
// 	firebase.database().ref('users/' + updateID).on('value', function(snapshot) {
// 		var values = snapshot.val();
// 		var updateData = '<div class="form-group">\
// 		        <label for="first_name" class="col-md-12 col-form-label">First Name</label>\
// 		        <div class="col-md-12">\
// 		            <input id="first_name" type="text" class="form-control" name="first_name" value="'+values.first_name+'" required autofocus>\
// 		        </div>\
// 		    </div>\
// 		    <div class="form-group">\
// 		        <label for="last_name" class="col-md-12 col-form-label">Last Name</label>\
// 		        <div class="col-md-12">\
// 		            <input id="last_name" type="text" class="form-control" name="last_name" value="'+values.last_name+'" required autofocus>\
// 		        </div>\
// 		    </div>';

// 		    $('#updateBody').html(updateData);
// 	});
// });

// $('.updateUserRecord').on('click', function() {
// 	var values = $(".users-update-record-model").serializeArray();
// 	var postData = {
// 	    first_name : values[0].value,
// 	    last_name : values[1].value,
// 	};

// 	var updates = {};
// 	updates['/users/' + updateID] = postData;

// 	firebase.database().ref().update(updates);

// 	$("#update-modal").modal('hide');
// });


// // Remove Data
// $("body").on('click', '.removeData', function() {
// 	var id = $(this).attr('data-id');
// 	$('body').find('.users-remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
// });

// $('.deleteMatchRecord').on('click', function(){
// 	var values = $(".users-remove-record-model").serializeArray();
// 	var id = values[0].value;
// 	firebase.database().ref('users/' + id).remove();
//     $('body').find('.users-remove-record-model').find( "input" ).remove();
// 	$("#remove-modal").modal('hide');
// });
// $('.remove-data-from-delete-form').click(function() {
// 	$('body').find('.users-remove-record-model').find( "input" ).remove();
// });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HN\Desktop\laravel\StudentMangmentCloud\resources\views/home.blade.php ENDPATH**/ ?>