document.addEventListener('click', function(e){
 if(e.target.matches('[data-add-product]')){
  const area=document.querySelector('#product-list');
  const row=area.querySelector('.product-row').cloneNode(true);
  row.querySelector('select').value='';
  row.querySelector('input').value='1';
  area.appendChild(row);
 }
 if(e.target.matches('[data-remove-product]')){
  const rows=document.querySelectorAll('.product-row');
  if(rows.length>1)e.target.closest('.product-row').remove();
 }
});
