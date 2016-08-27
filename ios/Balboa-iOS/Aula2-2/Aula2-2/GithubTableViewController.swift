//
//  GithubTableViewController.swift
//  Aula2-2
//
//  Created by Aluno on 27/08/16.
//  Copyright © 2016 fcv. All rights reserved.
//

import UIKit

class GithubTableViewController: UITableViewController {
    
    var dados = NSMutableArray()

    override func viewDidLoad() {
        super.viewDidLoad()
        atualizar()
        
        refreshControl?.addTarget(self, action: #selector(atualizar),
                                  forControlEvents: UIControlEvents.ValueChanged)
    }
    
    func atualizar() {
        let url = NSURL(string: "https://api.github.com/search/repositories?q=xamarin")
        let data = NSData(contentsOfURL: url!)
        
        if let json: NSDictionary = (try? NSJSONSerialization.JSONObjectWithData(data!, options: NSJSONReadingOptions.MutableContainers)) as? NSDictionary {
            
            if let items = json["items"] as? NSArray {
                
                dados.removeAllObjects()
                
                for item in items {
                    dados.addObject(item)
                }
                
            }
            
        }
        
        
        
        tableView.reloadData()
        
        refreshControl?.endRefreshing()
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }

    // MARK: - Table view data source

    override func numberOfSectionsInTableView(tableView: UITableView) -> Int {
        return 1
    }

    override func tableView(tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return dados.count
    }

    
    override func tableView(tableView: UITableView, cellForRowAtIndexPath indexPath: NSIndexPath) -> UITableViewCell {
        let cell = tableView.dequeueReusableCellWithIdentifier("gitcell", forIndexPath: indexPath) as! GitTableViewCell
        
        let item = dados[indexPath.row] as! NSDictionary

        cell.txtNome.text = item["name"] as? String
        cell.txtUrl.text = item["owner"]?.objectForKey("html_url") as? String
        
        return cell
    }
    

    /*
    // Override to support conditional editing of the table view.
    override func tableView(tableView: UITableView, canEditRowAtIndexPath indexPath: NSIndexPath) -> Bool {
        // Return false if you do not want the specified item to be editable.
        return true
    }
    */

    /*
    // Override to support editing the table view.
    override func tableView(tableView: UITableView, commitEditingStyle editingStyle: UITableViewCellEditingStyle, forRowAtIndexPath indexPath: NSIndexPath) {
        if editingStyle == .Delete {
            // Delete the row from the data source
            tableView.deleteRowsAtIndexPaths([indexPath], withRowAnimation: .Fade)
        } else if editingStyle == .Insert {
            // Create a new instance of the appropriate class, insert it into the array, and add a new row to the table view
        }    
    }
    */

    /*
    // Override to support rearranging the table view.
    override func tableView(tableView: UITableView, moveRowAtIndexPath fromIndexPath: NSIndexPath, toIndexPath: NSIndexPath) {

    }
    */

    /*
    // Override to support conditional rearranging of the table view.
    override func tableView(tableView: UITableView, canMoveRowAtIndexPath indexPath: NSIndexPath) -> Bool {
        // Return false if you do not want the item to be re-orderable.
        return true
    }
    */

    /*
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepareForSegue(segue: UIStoryboardSegue, sender: AnyObject?) {
        // Get the new view controller using segue.destinationViewController.
        // Pass the selected object to the new view controller.
    }
    */

}
