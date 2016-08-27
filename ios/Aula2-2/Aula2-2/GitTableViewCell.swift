//
//  GitTableViewCell.swift
//  Aula2-2
//
//  Created by Aluno on 27/08/16.
//  Copyright © 2016 fcv. All rights reserved.
//

import UIKit

class GitTableViewCell: UITableViewCell {
    
    @IBOutlet var txtNome: UILabel!
    
    @IBOutlet var txtUrl: UILabel!

    override func awakeFromNib() {
        super.awakeFromNib()
        // Initialization code
    }

    override func setSelected(selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)

        // Configure the view for the selected state
    }

}
