//
//  ViewController.swift
//  Aula-1-Balboa
//
//  Created by Aluno on 20/08/16.
//  Copyright © 2016 Aluno. All rights reserved.
//

import UIKit

class ViewController: UIViewController {
    
    // IBOutlet significa que o componente está ligado com algum componente na tela
    @IBOutlet var txtLogin: UITextField!
    
    @IBAction func logar(sender: AnyObject) {
        print(txtLogin.text);
    }
    
    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view, typically from a nib	.
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }


    
}

