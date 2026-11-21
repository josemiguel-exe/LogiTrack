<?php
require 'config/database.php'; $pageTitle='Produtos';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $id=(int)($_POST['id']??0); $name=trim($_POST['name']); $sku=trim($_POST['sku']); $weight=(float)$_POST['weight']; $quantity=(int)$_POST['quantity'];
 if($id){$s=$pdo->prepare("UPDATE products SET name=?,sku=?,weight=?,quantity=? WHERE id=?");$s->execute([$name,$sku,$weight,$quantity,$id]);}
 else{$s=$pdo->prepare("INSERT INTO products(name,sku,weight,quantity) VALUES(?,?,?,?)");$s->execute([$name,$sku,$weight,$quantity]);}
 header('Location: products.php');exit;
}
if(isset($_GET['delete'])){$pdo->prepare("DELETE FROM products WHERE id=?")->execute([(int)$_GET['delete']]);header('Location: products.php');exit;}
$edit=null;if(isset($_GET['edit'])){$s=$pdo->prepare("SELECT * FROM products WHERE id=?");$s->execute([(int)$_GET['edit']]);$edit=$s->fetch();}
$items=$pdo->query("SELECT * FROM products ORDER BY id DESC")->fetchAll();require 'includes/header.php';
?>
<h1 class="page-title mb-1">Produtos</h1><p class="muted mb-4">Cadastre e gerencie os produtos transportados.</p>
<div class="row g-4"><div class="col-lg-4"><div class="card content-card"><h5><?= $edit?'Editar':'Novo' ?> produto</h5><form method="post"><input type="hidden" name="id" value="<?= $edit['id']??'' ?>"><label class="form-label mt-2">Nome do produto</label><input class="form-control mb-3" name="name" required value="<?= htmlspecialchars($edit['name']??'') ?>"><label class="form-label">Código / SKU</label><input class="form-control mb-3" name="sku" value="<?= htmlspecialchars($edit['sku']??'') ?>"><label class="form-label">Peso (kg)</label><input class="form-control mb-3" type="number" step="0.01" min="0" name="weight" required value="<?= $edit['weight']??'0' ?>"><label class="form-label">Quantidade em estoque</label><input class="form-control mb-3" type="number" min="0" name="quantity" required value="<?= $edit['quantity']??'1' ?>"><button class="btn btn-primary w-100">Salvar produto</button></form></div></div>
<div class="col-lg-8"><div class="card content-card"><h5 class="mb-3">Produtos cadastrados</h5><div class="table-responsive"><table class="table"><thead><tr><th>Produto</th><th>SKU</th><th>Peso</th><th>Qtd.</th><th>Ações</th></tr></thead><tbody><?php foreach($items as $p): ?><tr><td><?= htmlspecialchars($p['name']) ?></td><td><?= htmlspecialchars($p['sku']) ?></td><td><?= $p['weight'] ?> kg</td><td><?= $p['quantity'] ?></td><td><a href="?edit=<?= $p['id'] ?>">Editar</a> · <a class="text-danger" onclick="return confirm('Excluir produto?')" href="?delete=<?= $p['id'] ?>">Excluir</a></td></tr><?php endforeach; ?><?php if(!$items): ?><tr><td colspan="5" class="muted">Nenhum produto cadastrado.</td></tr><?php endif; ?></tbody></table></div></div></div></div>
<?php require 'includes/footer.php'; ?>
