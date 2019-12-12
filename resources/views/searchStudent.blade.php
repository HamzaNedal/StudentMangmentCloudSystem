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
                            <strong>search info</strong>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form id="addUser" class="" method="POST" action="">
                            <label for="std_id" class="col-md-12 col-form-label">Student ID</label>

                            <div class="col-md-12">
                                <input id="std_id" type="text" class="form-control" name="std_id" value="" required autofocus>
                            </div>

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
                            <strong>All Students Listing</strong>
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
                            <th>GPA</th>
                            <th>Amount</th>
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


</form>




@endsection


@section('script')
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


$(document).on('click', '#submitUser', function(){

  function getHours(course_id) {
        course_id = ""+course_id;
       return database.collection('Course').doc(course_id).get().then(  function(res)  {
            if (typeof res.data() != "undefined") {
                return res.data().hours;
            }
         });

    }

    function  getGPA_amount(std_id) {
        var GPA = 0;
        var hour = 0;
        var amount = 0;
    return  database.collection('Grade').get().then( async function (snap) {
            for (let i = 0; i < snap.size; i++) {
                hours =  await getHours(snap.docs[i].data().course_id);
                if (typeof hours != "undefined") {
                    GPA+= (parseInt(snap.docs[i].data().grade)*parseInt(hours));
                    hour+=parseInt(hours);
                    amount+=parseInt(hours)*25;
                }
            }
            return [GPA/hour,amount];
        });
    }


database.collection('Student').doc($('#std_id').val()).get().then( async function (snap) {


    // console.log(arrCourses);
    var htmls = [];
    doc = snap.data();

   GPA_amount = await getGPA_amount(doc.std_id);

    htmls.push('<tr>\
                    <td>'+ doc.std_id +'</td>\
                    <td>'+ doc.first_name +'</td>\
                    <td>'+ doc.last_name +'</td>\
                    <td>'+ doc.email +'</td>\
                    <td>'+ doc.phone_nubmer +'</td>\
                    <td>'+ doc.dob +'</td>\
                    <td>'+ doc.level +'</td>\
                    <td>'+GPA_amount[0].toFixed(2) +'</td>\
                    <td>'+  GPA_amount[1] +'$</td>\
                </tr>');
        $('#tbody').html(htmls);

    });

});


</script>

@endsection
