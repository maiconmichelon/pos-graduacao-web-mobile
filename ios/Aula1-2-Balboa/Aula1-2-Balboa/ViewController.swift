//
//  ViewController.swift
//  Aula1-2-Balboa
//
//  Created by Aluno on 20/08/16.
//  Copyright © 2016 Aluno. All rights reserved.
//

import UIKit

class ViewController: UIViewController, UISearchBarDelegate {
    
    @IBOutlet var webView: UIWebView!
    
    @IBOutlet var search: UISearchBar!
    
    
//    let urlDescription = siteUrl.text!;
//    
//    // validar se foi digitada alguma string
//    let url = NSURL (string: urlDescription);
//    let requestObj = NSURLRequest(URL: url!);
//    webView.loadRequest(requestObj);
    
    override func viewDidLoad() {
        super.viewDidLoad();
        
        search.delegate = self;
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    func searchBarSearchButtonClicked(searchBar: UISearchBar) {
        let url = NSURL (string: searchBar.text!);
        let requestObj = NSURLRequest(URL: url!);
        webView.loadRequest(requestObj);
    }


}

