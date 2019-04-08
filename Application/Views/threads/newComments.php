


    
        <?php
        if(isLoggedIn())
        {
        ?>
        <div id="form-container" class="crear"> 
         <form method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
         <div id="reply">
             <div>
                 <div>Comentario</div>
                 <div><textarea name="comentario" cols="50" rows="5"></textarea></div>
             </div>
             <div>
                 <div><input class="btn blue" type="submit" name="enviar" value="Crear comentario"/></div>
             </div>
         </div>
    </form>
        <?php
        }
        ?>
     </div>
</div>