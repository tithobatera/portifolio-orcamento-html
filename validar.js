// Função de validação de todos os campos obrigatórios
function validarFormulario() {
  const nome = document.getElementById('nome');
  const morada = document.getElementById('morada');
  const telemovel = document.getElementById('telemovel');
  const email = document.getElementById('email');
  const tipoPagina = document.getElementById('tipoPagina');
  const prazoMeses = document.getElementById('prazoMeses');
  
  // Verificar se todos os campos obrigatórios estão preenchidos
  if (!nome.value.trim() || !morada.value.trim() || !telemovel.value.trim() || !email.value.trim() ||
      tipoPagina.value === "0" || prazoMeses.value === "-1") {
      alert("Por favor, preencha todos os campos obrigatórios. Dados pessoais, Tipo de página e Prazo");
      return false;
  }
  
  return true;
}



/*-----------------------------------------*/


