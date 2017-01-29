var calculadora = {
  valor1: 0,
  valor2: 0,
  resultado: 0,
  operador: '',
  setParametros: function(valor1, valor2, operador) {
    this.valor1 = parseFloat(valor1);
    this.valor2 = parseFloat(valor2);
    this.operador = operador;
  },
  getResultado: function() {
    return this.resultado;
  },
  verificaOperador: function() {
    if(this.operador == '+' || this.operador == '-' || this.operador == '/' || this.operador == '*') return true;
    else return false;
  },
  selecionaTipoDeCalculo: function() {
    switch(this.operador) {
      case '+':
        this.soma();
        break;
      case '-':
        this.subtracao();
        break;
      case '/':
        this.divisao();
        break;
      case '*':
        this.multiplicao();
        break;
      default:
        alert('Nunca vai cair aqui :v');
    }
  },
  calcular: function() {
    if(this.verificaOperador())
      this.selecionaTipoDeCalculo();
    else
      alert('O operador esta invalido!');
  },
  soma: function() {
    this.resultado = this.valor1 + this.valor2;
  },
  subtracao: function() {
    this.resultado = this.valor1 - this.valor2;
  },
  divisao: function() {
    this.resultado = this.valor1 / this.valor2;
  },
  multiplicao: function() {
    this.resultado = this.valor1 * this.valor2;
  }
};

$(function() {
  $( "#btnExec" ).click(function() {
    executar();
  });
  $( "#btnClear" ).click(function() {
    clearInputs();
  });
});

function clearInputs() {
  $('input').val('');
}

function executar() {
  var valor1 = $('#txtVa1').val(),
      valor2 = $('#txtVal2').val(),
      operador = $('#txtOpr').val(),
      resultado = $('#txtRep');

  calculadora.setParametros(valor1, valor2, operador);
  calculadora.calcular();
  resultado.val(calculadora.getResultado());
}
