<?php $__env->startSection('conteudo'); ?>
<form action="<?php echo e(route('matriculas.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="aluno" value="<?php echo e($dados[0]->id); ?>">
    <div class="row mb-2">
        <div class="col">
            <h4 class="display-7 text-secondary d-none d-md-block"><b>Matriculas de <?php echo e($dados[0]->nome); ?></b></h4>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <table class="table align-middle caption-top table-striped" id="tabela">

                <caption>Tabela de <b>Matricula</b></caption>
                <thead>
                    <tr class="header-table">
                        <th scope="col" class="text-left">Disciplina</th>
                        <th scope="col" class="text-center">Matricula</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo csrf_field(); ?>
                    <?php $__currentLoopData = $dados[1]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $disc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="col-md-6"><?php echo e($disc->nome); ?></td>
                        <td class="text-center col-md-6">
                            <input type="checkbox" name="matriculas[]" value="<?php echo e($disc->id); ?>"
                            <?php $__currentLoopData = $dados[2]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $matricula): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($matricula->disciplina_id == $disc->id): ?>
                            checked
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
            </table>
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <a href="<?php echo e(route('alunos.index')); ?>" class="btn btn-danger btn-block align-content-center w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                            <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z" />
                        </svg>
                        &nbsp;<b>Cancelar</b>
                    </a>
                </div>
                <div class="col-lg-8 col-md-12">
                    <button class="btn btn-success btn-block text-white mb-2 w-100" type="submit" id="bt_salvar">
                        <b>Confirmar</b>&nbsp;
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </svg>
                    </button>
                </div>
            </div>

        </div>
    </div>

    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('script'); ?>

    <script type="text/javascript"></script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.main', ['titulo' => "Matricular Aluno", 'permissions' => "App\Model\Matriculas"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ej200\Documents\IFPR ESTUDOS\Desenvolvimento Web II\Atividades-DevWebII\09-10-Autenticacao\resources\views/matriculas/index.blade.php ENDPATH**/ ?>