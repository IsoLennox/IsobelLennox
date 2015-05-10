<?php

function all_projects(){

global $connection;
    
    
                     ?>
                 
                  <div class="projects_container">
            <?php
            $query  = "SELECT * FROM projects WHERE published = 1 ORDER BY created DESC, id DESC";  
            $result = mysqli_query($connection, $query);
            $num_rows = mysqli_num_rows($result);
            if($num_rows>=1){
                //show each result value
                foreach($result as $show){
                echo "<div class='projects'>";    
                    if(empty($show['image'])){
                    echo "<a target='_blank' href='".$show['url']."' title='View Project'><img src='admin/default_project.png' alt=\"Project Screenshot\" /></a>";
                    }else{
                echo "<a target='_blank' href='".$show['url']."' title='View {$show['title']}'><img src='admin/{$show['image']}' alt=\"Project Screenshot\" /></a>";
                    }
                echo "<h3>".$show['title']."</h3> ";
                echo "<p>".$show['subtitle']."</p> ";
                echo "<p><em>".$show['created']."</em></p> "; 
                echo "<p>".$show['created_for']."</p> "; 
                $skill_query  = "SELECT * FROM skill_project WHERE project_id={$show['id']}";  
                $skill_result = mysqli_query($connection, $skill_query);
                $skill_num_rows = mysqli_num_rows($skill_result);
                if($skill_num_rows>=1){  
                     echo "<p><strong>Skills:</strong> ";
                foreach($skill_result as $skill_show){
                        $skill_name_query  = "SELECT * FROM skills WHERE id={$skill_show['skill_id']} ";  
                        $skill_name_result = mysqli_query($connection, $skill_name_query); 
                        if($skill_name_result){  
                            $skill_array=mysqli_fetch_assoc($skill_name_result);
                        echo  $skill_array['name'].", "; 
                        }//end print skill name 
                    
                }//end loop through skills if found  
                    echo "</p>";
                   
                }//end get skills 
                    
                    
                echo "<a href=\"".$show['url']."\" >View this Project</a>";

                echo "</div> ";

                    echo "<hr/>";
                }//end show each project
            }else{ echo "Isobel does not have any projects yet!"; } ?>

                 <hr/>
       
        </div>
        <?php
    
}