//: Playground - noun: a place where people can play

import UIKit

var a = "Teste"
var b = "Teste"

if (a == b) {
    // se são valores iguais
}

//if (a === b) {
//    // se apontam para a mesma referência
//}

class Veiculo {
    var marca: String = "";
    var modelo: String = "";
    var ano: Int = 0;
}

// Herança
class Carro : Veiculo {
    
    var nome: String {
        get {
            // quando fizer carro.nome vai mostrar as variáveis do veiculo
            return "\(marca) \(modelo)"
        }
    }
    
}

var carro = Carro()
carro.marca = "Nissan"
carro.modelo = "Micra"
carro.nome

class Bike : Veiculo {

    var velocidade: Double = 0
    
    override var ano: Int {
        willSet {
            if (ano < 1990) {
                print("Bike velha")
            } else {
                print("Bike nova")
            }
        }
    }
    
    override init() {
        super.init()
        marca = "Caloi"
    }
    
    func acelerar() {
        velocidade += 10
    }
    
    func acelerar(velocidade: Double) {
        self.velocidade += velocidade
    }
}

var bike = Bike()
bike.ano = 1980
bike.ano = 2000

struct Cidade {
    var nome = "Maringá"
}

enum Status: Int {
    case Ativo = 1, Inativo = 0, Excluido = 2, Cancelado = 3
}

var idade: Int?
idade = 35
var texto = "150"
idade =  Int (texto)

var teste = idade ?? 5
var teste2 = (idade <= 99) ? idade : 5
var teste3 = idade?.toIntMax()

var idade2: Int?
var teste4 = idade2?.toIntMax()
