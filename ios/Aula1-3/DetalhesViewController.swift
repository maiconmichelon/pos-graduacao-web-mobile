//
//  DetalhesViewController.swift
//  Aula1-3
//
//  Created by Aluno on 20/08/16.
//  Copyright © 2016 Aluno. All rights reserved.
//

import UIKit

class DetalhesViewController: UIViewController {
    
    var detalhes = "";

    @IBOutlet var descricaoProduto: UILabel!
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        descricaoProduto.text = detalhes;
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    

    /*
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepareForSegue(segue: UIStoryboardSegue, sender: AnyObject?) {
        // Get the new view controller using segue.destinationViewController.
        // Pass the selected object to the new view controller.
    }
    */

}
