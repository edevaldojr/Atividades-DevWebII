<div>

    <table class="table align-middle caption-top table-striped">
        <caption>Tabela de <b>Vínculos</b></caption>
        <thead>
        <tr>
            <?php $cont=0; ?>
            <?php $__currentLoopData = $header; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php if($hide[$cont]): ?>
                    <th scope="col" class="d-none d-md-table-cell"><?php echo e($item); ?></th>
                <?php else: ?>
                    <th scope="col"><?php echo e($item); ?></th>
                <?php endif; ?>
                <?php $cont++; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
        </thead>
        <tbody>

            <form action="<?php echo e(route('vinculos.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
                <tr>
                    <?php $__currentLoopData = $data[2]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $disciplina): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td>
                        <?php echo e($disciplina['nome']); ?>

                    </td>
                    <td>
                        <select name="professores[]" class="form-control">
                            <?php $__currentLoopData = $data[1]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prof): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $ip=0 ?>
                                <?php $__currentLoopData = $data[2]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vinculos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($vinculos->disciplina_id == $disciplina->id): ?>
                                        <?php $ip = $vinculos->professor_id  ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php if($ip == $prof->id): ?>
                                    <option value="<?php echo e($disciplina->id); ?>_<?php echo e($prof->id); ?>" selected="true">
                                <?php else: ?>
                                    <option value="<?php echo e($disciplina->id); ?>_<?php echo e($prof->id); ?>">
                                <?php endif; ?>
                                <?php echo e($prof['nome']); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </form>
            <tfoot>
                <td>
                <a href="<?php echo e(route('vinculos.index')); ?>" class="btn btn-secondary btn-block align-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                    </svg>
                    &nbsp; Voltar
                </a>
                <a href="javascript:document.querySelector('form').submit();" class="btn btn-success btn-block align-content-center">
                    Confirmar &nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                </a>
                </td>
            </tfoot>
        </tbody>
    </table>

</div>
<?php /**PATH C:\Users\ej200\Documents\IFPR ESTUDOS\Desenvolvimento Web II\Atividades-DevWebII\09-10-Autenticacao\resources\views/components/datalistVinculo.blade.php ENDPATH**/ ?>