<!-- Herda o layout padrão definido no template "main" -->

<!-- Preenche o conteúdo da seção "titulo" -->
<?php $__env->startSection('titulo'); ?> Professor <?php $__env->stopSection(); ?>
<!-- Preenche o conteúdo da seção "conteudo" -->
<?php $__env->startSection('conteudo'); ?>

<form action="<?php echo e(route('professores.update', $dados['id'])); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="row">
            <div class="col">
                <input
                class="btn-check <?php echo e($errors->has('ativo') ? 'is-invalid' : ''); ?>"
                type="radio"
                name="ativo"
                id="ativo"
                value="1"
                />
                <label class="btn btn-outline-secondary" for="ativo">ATIVO</label>
                    <input
                class="btn-check <?php echo e($errors->has('ativo') ? 'is-invalid' : ''); ?>"
                type="radio"
                name="ativo"
                id="inativo"
                value="0"
                />
                <label class="btn btn-outline-secondary" for="inativo">INATIVO</label>
                    <?php if($errors->has('ativo')): ?>
                        <div class='invalid-feedback'>
                            <?php echo e($errors->first('ativo')); ?>

                        </div>
                    <?php endif; ?>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col" >
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control <?php echo e($errors->has('nome') ? 'is-invalid' : ''); ?>"
                        name="nome"
                        placeholder="nome"
                        value="<?php echo e($dados['nome']); ?>"
                    />
                    <?php if($errors->has('nome')): ?>
                        <div class='invalid-feedback'>
                            <?php echo e($errors->first('nome')); ?>

                        </div>
                    <?php endif; ?>
                    <label for="nome">Nome do Professor</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col" >
                <div class="form-floating mb-3">
                    <input
                        type="email"
                        class="form-control <?php echo e($errors->has('email') ? 'is-invalid' : ''); ?>"
                        name="email"
                        placeholder="email"
                        value="<?php echo e($dados['email']); ?>"
                    />
                    <?php if($errors->has('email')): ?>
                        <div class='invalid-feedback'>
                            <?php echo e($errors->first('email')); ?>

                        </div>
                    <?php endif; ?>
                    <label for="email">E-mail do Professor</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col" >
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control <?php echo e($errors->has('siape') ? 'is-invalid' : ''); ?>"
                        name="siape"
                        placeholder="Siape"
                        value="<?php echo e($dados['siape']); ?>"
                    />
                    <?php if($errors->has('siape')): ?>
                        <div class='invalid-feedback'>
                            <?php echo e($errors->first('siape')); ?>

                        </div>
                    <?php endif; ?>
                    <label for="siape">SIAPE do Professor</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01" >Eixo</label>
                    <select name="eixo_id" class="form-control <?php echo e($errors->has('eixo_id') ? 'is-invalid' : ''); ?>">
                        <?php $__currentLoopData = $eixos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item->id); ?>" <?php if($item->id == old('eixo_id')): ?> selected="true" <?php endif; ?>>
                            <?php echo e($item->nome); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>
    <div class="row">
        <div class="col">
            <a href="<?php echo e(route('professores.index')); ?>" class="btn btn-secondary btn-block align-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                    <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                </svg>
                &nbsp; Voltar
            </a>
            <button type="submit" class="btn btn-success btn-block align-content-center">
                Confirmar &nbsp;
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
            </button>
        </div>
    </div>
    <?php if(isset($errors)): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $erro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="alert alert-danger">
                <?php echo e($erro); ?>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.main', ['titulo' => "Alterar Professor"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ej200\Documents\IFPR ESTUDOS\Desenvolvimento Web II\Atividades-DevWebII\09-10-Autenticacao\resources\views/professores/edit.blade.php ENDPATH**/ ?>