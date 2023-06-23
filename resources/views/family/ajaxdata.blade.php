<div class="tree">
    <ul>
        <li>
            <?php
      foreach ($result as $key => $value) {
        //echo json_encode($value);
        echo "<a href='".route('families-edit', $value['id'])."' title='Action' data-bs-toggle='popover' data-bs-trigger='hover' data-bs-content='Click for edit data'>".$value['name']."</a>";
        echo "<ul>";
          foreach($value['children'] as $d){
            echo "<li><a href='".route('families-edit', $d['id'])."' title='Action' data-bs-toggle='popover' data-bs-trigger='hover' data-bs-content='Click for edit data'>".$d['name']."</a>";
            echo "<ul>";
            foreach ($d['children'] as $ch) {
                echo "<li><a href ='".route('families-edit', $ch['id'])."' title='Action' data-bs-toggle='popover' data-bs-trigger='hover' data-bs-content='Click for edit data'>".$ch['name']."</a></li>";
              }
              echo "</ul>";
            echo "</li>";
          }
        echo "</ul>";
      }

    ?>
        </li>
    </ul>
</div>