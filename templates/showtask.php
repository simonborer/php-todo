<div class="card border-primary" style="width: 50%"> 
  <div class="card-header">
    <div class="row">
      
      <div class="col-sm">
        Due By:  
        <?php if ($task["dueDate"] != '') {
          // If there's a due date, display it.
          echo date('n/j/Y', strtotime($task["dueDate"]));
        } else  { 
          // If there isn't a due date, 
          // show the text "Not specified"
          echo "Not specified";
        } ?> <!-- else -->
      </div>
      
      <div class="col-sm">
        <?php
          switch($task["priority"]) { 
            case 'Normal': ?>
              <span class="badge float-right badge-warning">Priority: Normal</span> 
          <?php
            break; 
            case 'High': ?>
              <span class="badge float-right badge-danger">Priority: High</span> 
          <?php
            break; 
            case 'Low': ?>
              <span class="badge float-right badge-success">Priority: Low</span> 
          <?php
            break;
        } ?>
      </div>
    </div> <!-- Row #1 -->
  </div> <!-- Header -->
  
  <div class="card-body">
    <div class="card-title"><?php echo $task["summary"]; ?></div>
    <p class="card-text"><?php echo $task["details"]; ?></p>
  </div> <!-- Body -->
  
  <div class="card-footer">
    <div class="row">
      <div class="col-sm">
      
      <?php if ($task["isComplete"] == 'false') { ?>
        <div><span class="badge badge-secondary">Incomplete</span></div>
      <?php } else { ?>
        <div><span class="badge badge-secondary">Complete</span></div>
      <?php } ?>
      
      </div>
      <div class="col-sm">
        <ul class="nav justify-content-end nav-pills card-header-pills">
        
        <?php 
          // If the task is not complete, create a link to the 
          // 'edit task' page, with a query parameter of id
          // equal to the task's id.
          if ($task["isComplete"] == 'false') { ?>
          <li class="nav-item"><a class="nav-link" href="/pages/edittask.php?id=<?php echo $task["id"] ?>"><i class="fas fa-edit"></i></a></li>
        <?php } ?>
          <!-- 
            Create a link to the 'delete task' page, 
            with a query parameter of id
            equal to the task's id. 
          -->
          <li class="nav-item"><a class="nav-link" href="/pages/deletetask.php?id=<?php echo $task["id"] ?>"> <i class="fas fa-trash-alt"></i></a></li>

          <!-- 
            Create a link to the 'delete task' page, 
            with a query parameter of id
            equal to the task's id. 
          -->
          <li class="nav-item">
          <!-- 
            This form will execute the commands in 
            'performcomplete.php' with a query parameter of id
            equal to the task's id. 
          -->
            <form method="post" action="/actions/performcomplete.php?id=<?php echo $task["id"] ?>">
              <button type="submit" class="btn btn-link">
              
              <!-- 
                If the task is not complete, show the 'check' icon
                as the content of the button. Otherwise, show the 
                'redo' icon.
              -->
              <?php if ($task["isComplete"] == 'false') { ?>
                <i class="fas fa-check"></i>
              <?php } else { ?>
                <i class="fas fa-redo-alt"></i>
              <?php } ?>
            
              </button>
            </form>
          </li>
        </ul>
      </div>  
    </div>
  </div>
</div>