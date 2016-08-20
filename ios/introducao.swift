//: Playground - noun: a place where people can play

import UIKit

var str = "Hello, playground"

var ano: Int;
ano = 2016;

var texto = "Hoje é ";
texto += "sábado de chuva";

var altura: Float?;
altura?.hashValue; // valida antes se é nulo, não acontece exception
// altura!.hashValue; // caso seja nulo, vai dar exception. comentado para continuar a execução

altura = 2.00;

// constante
let dia = 20;

// interpolar
let a = 3, b = 5;
let result = "\(a) vezes \(b) é \(a * b)"

// array e dicionario
var nomes: [String] = ["Leandro", "Ana", "Luiza"]
var idades = ["Leandro": 34, "Ana": 2, "Luiza": 67];

// tuples
let erro400 = (404, "NotFound")

// repetição
//for n in 0...5 {
//    print(n);
//}

// foreach
for (nome, idade) in idades {
    print("\(nome) tem \(idade) anos");
    
    switch idade {
    case 0:
        print("Recém nascido");
    case 1...17:
        print("Menor de idade");
    default:
        print("Maior de idade");
    }
    
    print("\n");
}

func ola(nome: String = "Mundo") {
    print("Olá, \(nome)");
}

ola("Enfermeira");
ola();

func olar(nome: String) {
    print("Olar, \(nome)");
}

olar("Enfermeira");
