<?php
require 'config/database.php';$pageTitle='Fretes';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $pdo->beginTransaction();
 try{
  $s=$pdo->prepare("INSERT INTO freights(transporter_id,origin_id,destination_id,freight_date,status,notes) VALUES(?,?,?,?,?,?)");
  $s->execute([(int)$_POST['transporter_id'],(int)$_POST['origin_id'],(int)$_POST['destination_id'],$_POST['freight_date'],$_POST['status'],trim($_POST['notes'])]);
  $freightId=(int)$pdo->lastInsertId();
  $link=$pdo->prepare("INSERT INTO freight_products(freight_id,product_id,quantity) VALUES(?,?,?)");
  foreach($_POST['product_id'] as $i=>$productId){if($productId!=='')$link->execute([$freightId,(int)$productId,max(1,(int)$_POST['product_qty'][$i])]);}
  $pdo->commit();header('Location: freights.php');exit;
 }catch(Throwable $e){$pdo->rollBack();$error='Não foi possível salvar o frete: '.$e->getMessage();}
}
$products=$pdo->query("SELECT * FROM products ORDER BY name")->fetchAll();
$transporters=$pdo->query("SELECT * FROM transporters ORDER BY name")->fetchAll();
$addresses=$pdo->query("SELECT * FROM addresses ORDER BY label")->fetchAll();
$items=$pdo->query("SELECT f.*,t.name transporter,o.label origin,d.label destination FROM freights f JOIN transporters t ON t.id=f.transporter_id JOIN addresses o ON o.id=f.origin_id JOIN addresses d ON d.id=f.destination_id ORDER BY f.id DESC")->fetchAll();
require 'includes/header.php';?>
<h1 class="page-title">Fretes</h1><p class="muted mb-4">Crie uma viagem relacionando transportador, endereços e vários produtos.</p>
<?php if(isset($error)): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<div class="card content-card mb-4"><h5 class="mb-3">Cadastrar novo frete</h5>
<?php if(!$products||!$transporters||count($addresses)<2): ?><div class="alert alert-warning mb-0">Antes de criar um frete, cadastre produtos, um transportador e pelo menos dois endereços.</div><?php else: ?>
<form method="post"><div class="row g-3"><div class="col-md-4"><label class="form-label">Transportador</label><select class="form-select" name="transporter_id" required><option value="">Selecione</option><?php foreach($transporters as $t): ?><option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['name']) ?></option><?php endforeach; ?></select></div><div class="col-md-4"><label class="form-label">Origem</label><select class="form-select" name="origin_id" required><option value="">Selecione</option><?php foreach($addresses as $a): ?><option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['label']) ?></option><?php endforeach; ?></select></div><div class="col-md-4"><label class="form-label">Destino</label><select class="form-select" name="destination_id" required><option value="">Selecione</option><?php foreach($addresses as $a): ?><option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['label']) ?></option><?php endforeach; ?></select></div><div class="col-md-4"><label class="form-label">Data do frete</label><input class="form-control" type="date" name="freight_date" required value="<?= date('Y-m-d') ?>"></div><div class="col-md-4"><label class="form-label">Status</label><select class="form-select" name="status"><option>Planejado</option><option>Em trânsito</option><option>Entregue</option></select></div><div class="col-md-4"><label class="form-label">Observações</label><input class="form-control" name="notes" placeholder="Opcional"></div></div>
<hr><div class="d-flex justify-content-between align-items-center mb-2"><h6>Produtos do frete</h6><button type="button" class="btn btn-sm btn-outline-primary" data-add-product>+ Adicionar produto</button></div><div id="product-list"><div class="row g-2 product-row mb-2"><div class="col-8"><select class="form-select" name="product_id[]" required><option value="">Selecione um produto</option><?php foreach($products as $p): ?><option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?></option><?php endforeach; ?></select></div><div class="col-3"><input class="form-control" type="number" min="1" name="product_qty[]" value="1" required></div><div class="col-1"><button type="button" class="btn btn-outline-danger" data-remove-product>×</button></div></div></div><button class="btn btn-primary mt-3">Gerar frete</button></form><?php endif; ?></div>
<div class="card content-card"><h5 class="mb-3">Fretes cadastrados</h5><div class="table-responsive"><table class="table"><thead><tr><th>Nº</th><th>Data</th><th>Transportador</th><th>Origem</th><th>Destino</th><th>Status</th></tr></thead><tbody><?php foreach($items as $f): ?><tr><td>#<?= $f['id'] ?></td><td><?= date('d/m/Y',strtotime($f['freight_date'])) ?></td><td><?= htmlspecialchars($f['transporter']) ?></td><td><?= htmlspecialchars($f['origin']) ?></td><td><?= htmlspecialchars($f['destination']) ?></td><td><?= htmlspecialchars($f['status']) ?></td></tr><?php endforeach; ?><?php if(!$items): ?><tr><td colspan="6" class="muted">Nenhum frete cadastrado.</td></tr><?php endif; ?></tbody></table></div></div>
<?php require 'includes/footer.php'; ?>
