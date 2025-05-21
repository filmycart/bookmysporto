<html>

  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!--       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script> -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>

  <body>
    <button id="add-student-btn" data-toggle="modal" data-target="#modalForm">
      Add Student
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modalForm" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <form role="form" id='myForm'>
          <!-- Modal Header -->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span>
              <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Add Student</h4>
          </div>

          <!-- Modal Body -->
          <div class="modal-body">
            <p class="statusMsg"></p>            
              <div class="form-group">
                <label for="inputName">Name</label>
                <input type="text" class="form-control" id="inputName" name="
inputName" placeholder="Enter the Name here" />
              </div>
              <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Enter the email here" />
              </div>
              <div class="form-group">
                <label for="inputPhone">Phone</label>
                <input type="tel" class="form-control" id="inputPhone" name="inputPhone" placeholder="Enter the Phone Number here" />
              </div>

              <div class="form-group">
                <label for="inputstudent_id">Student ID</label>
                <input type="text" class="form-control" id="inputstudent_id" name="inputstudent_id" placeholder="Enter the Student ID here" />
              </div>

              <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status">
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                </select>
              </div>            
          </div>

          <!-- Modal Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary submitBtn">Add Student</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </body>

</html>
<script type="text/javascript">
$("#myForm").validate({
  rules: {
    inputName: {
      required: true,
      letterswithspace: true
    },
    inputEmail: {
      required: true,
      email: true
    },
    inputPhone: {
      required: true,
      minlength: 10,
      maxlength: 10,
      digits: true
    }
  },
  messages: {
    inputName: {
      required: "Please enter a name.",
      letterswithspace: "Please enter a valid name with letters and spaces only."
    },
    inputEmail: {
      required: "Please enter an email address.",
      email: "Please enter a valid email address."
    },
    inputPhone: {
      required: "Please enter a phone number.",
      minlength: "Please enter a valid 10-digit phone number.",
      maxlength: "Please enter a valid 10-digit phone number.",
      digits: "Please enter a valid 10-digit phone number."
    }
  },
  errorElement: "span",
  errorClass: "help-block",
  highlight: function(element, errorClass, validClass) {
    $(element).closest(".form-group").addClass("has-error");
  },
  unhighlight: function(element, errorClass, validClass) {
    $(element).closest(".form-group").removeClass("has-error");
  },
  submitHandler: function(form) {
    var name = document.getElementById("inputName").value.trim();
    var email = document.getElementById("inputEmail").value.trim();
    var phone = document.getElementById("inputPhone").value.trim();
    var student_id = document.getElementById("inputstudent_id").value.trim();
    var status = document.getElementById("status").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "add_students.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        // window.location.reload();
        $('#modalForm').modal('hide');
        var table = $('#studentsTable').DataTable();
        table.ajax.reload();
      }
    };
    xhr.send("name=" + name + "&email=" + email + "&phone=" + phone + "&student_id=" + student_id + "&status=" + status);
  }
});
</script>