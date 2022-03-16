<!-- ------------------ PAGINADOR ---------------------  -->
<section class="paginacion clear">
    <ul class="paginador">
    <?php
        $total_pag = $paginador[2];
        $total_registro = $paginador[3];
        if($total_registro>=$rango){

            ?><li class="<?php echo $recibido<=1 ? 'disabled' : '' ?>"><a href="<?php echo $section; ?>?pagina=<?php echo $recibido-1; ?>">«</a></li><?php

            if($total_pag<=$rango){
                for($i=1; $i<=$total_pag; $i++):?>
                    <li><a class="<?php echo $recibido==$i ? 'active' : '' ?>" href="<?php echo $section; ?>?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor;
            }else{

                for($i=max(1, min($recibido-4,$total_pag-($rango-1))); $i<=max($rango, min($recibido+5,$total_pag)); $i++):?>
                    <li><a class="<?php echo $recibido==$i ? 'active' : '' ?>" href="<?php echo $section; ?>?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor;
            }

            ?><li class="<?php echo $recibido>=$total_pag ? 'disabled' : '' ?>"><a href="<?php echo $section; ?>?pagina=<?php echo $recibido+1; ?>">»</a></li><?php

            }
        ?>
        </ul>
</section>