  function showModal(userID) {
    document.getElementById("assignUrl").value = userID;
    document.getElementById("UserDepartmentModal").style.display = "block";
   }
  function showModal1(userID) {
   document.getElementById("assignUrl1").value = userID;
   document.getElementById("NewAgentModal").style.display = "block";
   }

  function showModal2(userID) {
   document.getElementById("assignUrl2").value = userID;
   document.getElementById("NewAdminModal").style.display = "block";
   }

  function closeModal() {
   document.getElementById("UserDepartmentModal").style.display = "none";
   document.getElementById("NewAgentModal").style.display = "none";
   document.getElementById("NewAdminModal").style.display = "none";
  }
  function performAction(action, userID, departmentID = 0) {
    var url;
  
    if (action === 'promotion' || action === 'demotion') {
      url = "../background/promotions_demotions.php?user_id=" + userID + "&action_type=" + action + "&new_department_id=" + departmentID;
    }
    if (action === 'ban') {
      url = "../background/ban_accounts.php?user_id=" + userID;
    }
    if (action === 'transfer'){
     url = "../background/department_transfers.php?user_id=" + userID + "&action_type=" + action + "&new_department_id=" + departmentID;
    }
  
    window.location.href = url;
  }
  
  function confirmPerformAction(action,userID,departmentID = 0) {
   if(action == "ban"){
    if (confirm("Are you sure you want to ban this user? All their user data and tickets will be lost!")) {
     performAction(action,userID);
    }
   }
   if(action == 'promotion'){
    if (confirm("Are you sure you want to promote this user?")) {
     performAction(action,userID,departmentID);
   }
   }
   if(action == 'demotion'){
    if (confirm("Are you sure you want to demote this user?")) {
     performAction(action,userID,departmentID);
   }
   }
   }
   function confirmPerformAction1(action,userID,departmentID = 0) {
   if(action == "ban"){
    if (confirm("Are you sure you want to ban this user? All their user data and tickets will be lost!")) {
     performAction(action,userID);
    }
   }
   if(action == 'promotion'){
    if (confirm("Are you sure you want to promote this user?")) {
     var CorrectuserID = document.getElementById("assignUrl1").value;
     performAction(action,CorrectuserID,departmentID);
   }
   }
   if(action == 'demotion'){
    if (confirm("Are you sure you want to demote this user?")) {
     CorrectuserID = document.getElementById("assignUrl1").value;
     performAction(action,CorrectuserID,departmentID);
    }
   }
   if(action == 'transfer'){
    if (confirm("Are you sure you want to transfer this user to a different department? They will lose all the tickets they are currently working on!")) {
     CorrectuserID = document.getElementById("assignUrl").value;
     performAction(action,CorrectuserID,departmentID);
   }
   }
  }

  function promoteToAdmin(userID,AdminType){
   var action = 'promotion';
   url = "../background/promotions_demotions.php?user_id=" + userID + "&action_type=" + action + "&new_admintype=" + AdminType;
   window.location.href = url;
  }

  function confirmPerformAction2(userID,AdminType = 0){
    if (confirm("Are you sure you want to promote this user to admin? You may not be able to demote them back afterwards!")) {
     CorrectuserID = document.getElementById("assignUrl2").value;
     promoteToAdmin(CorrectuserID,AdminType);
    }
  }

  function chooseNewDepartment(action,userID){
   document.getElementById("UserDepartmentModal").style.display = "none";
   document.getElementById("NewAgentModal").style.display = "none";
   var departmentID = document.querySelector("input[name='department']:checked").value;
   confirmPerformAction1(action,userID,departmentID);
  }

 function chooseAdminType(userID){
  document.getElementById("UserDepartmentModal").style.display = "none";
  document.getElementById("NewAgentModal").style.display = "none";
  document.getElementById("NewAdminModal").style.display = "none";
  var AdminType = document.querySelector("input[name='admin_type']:checked").value;
  confirmPerformAction2(userID,AdminType);
 }