<?php $__env->startSection('titulo'); ?> Alunos <?php $__env->stopSection(); ?>
<?php $__env->startSection('conteudo'); ?>

    <div class="row">
        <div class="col">

            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.datalistAluno','data' => ['header' => ['ID', 'NOME', 'CURSO', 'AÇAO'],'data' => $dados,'hide' => [true,true, false, false]]] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('datalistAluno'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['header' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['ID', 'NOME', 'CURSO', 'AÇAO']),'data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($dados),'hide' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([true,true, false, false])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.main', [
    'titulo' => "Alunos",
    'rota' => "alunos.create",
    'permissions' => "App\Model\Aluno"

], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ej200\Documents\IFPR ESTUDOS\Desenvolvimento Web II\Atividades-DevWebII\09-10-Autenticacao\resources\views/alunos/index.blade.php ENDPATH**/ ?>