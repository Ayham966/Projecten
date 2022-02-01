namespace Gimpies
{
    partial class ProductDash
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.dataGridView = new System.Windows.Forms.DataGridView();
            this.txtMark = new System.Windows.Forms.TextBox();
            this.labMark = new System.Windows.Forms.Label();
            this.labColor = new System.Windows.Forms.Label();
            this.txtColor = new System.Windows.Forms.TextBox();
            this.labSize = new System.Windows.Forms.Label();
            this.txtSize = new System.Windows.Forms.TextBox();
            this.labPrice = new System.Windows.Forms.Label();
            this.txtPrice = new System.Windows.Forms.TextBox();
            this.btnRemove = new System.Windows.Forms.Button();
            this.btnAdd = new System.Windows.Forms.Button();
            this.btnUpdate = new System.Windows.Forms.Button();
            this.btnBack = new System.Windows.Forms.Button();
            this.labDoll = new System.Windows.Forms.Label();
            this.labAmount = new System.Windows.Forms.Label();
            this.txtAmount = new System.Windows.Forms.TextBox();
            this.btnHistory = new System.Windows.Forms.Button();
            this.btnShowPro = new System.Windows.Forms.Button();
            this.RemoveHis = new System.Windows.Forms.Button();
            this.labSell = new System.Windows.Forms.Label();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridView)).BeginInit();
            this.SuspendLayout();
            // 
            // dataGridView
            // 
            this.dataGridView.AllowUserToAddRows = false;
            this.dataGridView.AllowUserToDeleteRows = false;
            this.dataGridView.AllowUserToResizeColumns = false;
            this.dataGridView.AllowUserToResizeRows = false;
            this.dataGridView.BackgroundColor = System.Drawing.SystemColors.ButtonHighlight;
            this.dataGridView.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dataGridView.Cursor = System.Windows.Forms.Cursors.Hand;
            this.dataGridView.Location = new System.Drawing.Point(249, 35);
            this.dataGridView.MultiSelect = false;
            this.dataGridView.Name = "dataGridView";
            this.dataGridView.ReadOnly = true;
            this.dataGridView.RowHeadersVisible = false;
            this.dataGridView.RowHeadersWidthSizeMode = System.Windows.Forms.DataGridViewRowHeadersWidthSizeMode.AutoSizeToAllHeaders;
            this.dataGridView.SelectionMode = System.Windows.Forms.DataGridViewSelectionMode.FullRowSelect;
            this.dataGridView.Size = new System.Drawing.Size(524, 232);
            this.dataGridView.TabIndex = 0;
            this.dataGridView.CellContentClick += new System.Windows.Forms.DataGridViewCellEventHandler(this.dataGridView_CellContentClick);
            // 
            // txtMark
            // 
            this.txtMark.Location = new System.Drawing.Point(85, 52);
            this.txtMark.MaxLength = 15;
            this.txtMark.Multiline = true;
            this.txtMark.Name = "txtMark";
            this.txtMark.Size = new System.Drawing.Size(101, 24);
            this.txtMark.TabIndex = 1;
            // 
            // labMark
            // 
            this.labMark.AutoSize = true;
            this.labMark.BackColor = System.Drawing.Color.Transparent;
            this.labMark.Font = new System.Drawing.Font("Microsoft Tai Le", 11.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.labMark.ForeColor = System.Drawing.SystemColors.ControlText;
            this.labMark.Location = new System.Drawing.Point(29, 57);
            this.labMark.Name = "labMark";
            this.labMark.Size = new System.Drawing.Size(45, 19);
            this.labMark.TabIndex = 2;
            this.labMark.Text = "Mark:";
            // 
            // labColor
            // 
            this.labColor.AutoSize = true;
            this.labColor.BackColor = System.Drawing.Color.Transparent;
            this.labColor.Font = new System.Drawing.Font("Microsoft Tai Le", 11.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.labColor.ForeColor = System.Drawing.SystemColors.ControlText;
            this.labColor.Location = new System.Drawing.Point(29, 87);
            this.labColor.Name = "labColor";
            this.labColor.Size = new System.Drawing.Size(48, 19);
            this.labColor.TabIndex = 4;
            this.labColor.Text = "Color:";
            // 
            // txtColor
            // 
            this.txtColor.Location = new System.Drawing.Point(85, 82);
            this.txtColor.MaxLength = 10;
            this.txtColor.Multiline = true;
            this.txtColor.Name = "txtColor";
            this.txtColor.Size = new System.Drawing.Size(101, 24);
            this.txtColor.TabIndex = 3;
            // 
            // labSize
            // 
            this.labSize.AutoSize = true;
            this.labSize.BackColor = System.Drawing.Color.Transparent;
            this.labSize.Font = new System.Drawing.Font("Microsoft Tai Le", 11.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.labSize.ForeColor = System.Drawing.SystemColors.ControlText;
            this.labSize.Location = new System.Drawing.Point(29, 117);
            this.labSize.Name = "labSize";
            this.labSize.Size = new System.Drawing.Size(39, 19);
            this.labSize.TabIndex = 6;
            this.labSize.Text = "Size:";
            // 
            // txtSize
            // 
            this.txtSize.Location = new System.Drawing.Point(85, 112);
            this.txtSize.MaxLength = 2;
            this.txtSize.Multiline = true;
            this.txtSize.Name = "txtSize";
            this.txtSize.Size = new System.Drawing.Size(66, 24);
            this.txtSize.TabIndex = 5;
            this.txtSize.TextChanged += new System.EventHandler(this.txtSize_TextChanged);
            // 
            // labPrice
            // 
            this.labPrice.AutoSize = true;
            this.labPrice.BackColor = System.Drawing.Color.Transparent;
            this.labPrice.Font = new System.Drawing.Font("Microsoft Tai Le", 11.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.labPrice.ForeColor = System.Drawing.SystemColors.ControlText;
            this.labPrice.Location = new System.Drawing.Point(29, 147);
            this.labPrice.Name = "labPrice";
            this.labPrice.Size = new System.Drawing.Size(44, 19);
            this.labPrice.TabIndex = 8;
            this.labPrice.Text = "Price:";
            // 
            // txtPrice
            // 
            this.txtPrice.Location = new System.Drawing.Point(85, 142);
            this.txtPrice.MaxLength = 4;
            this.txtPrice.Multiline = true;
            this.txtPrice.Name = "txtPrice";
            this.txtPrice.Size = new System.Drawing.Size(66, 24);
            this.txtPrice.TabIndex = 7;
            this.txtPrice.TextChanged += new System.EventHandler(this.txtPrice_TextChanged);
            // 
            // btnRemove
            // 
            this.btnRemove.Location = new System.Drawing.Point(249, 273);
            this.btnRemove.Name = "btnRemove";
            this.btnRemove.Size = new System.Drawing.Size(75, 23);
            this.btnRemove.TabIndex = 9;
            this.btnRemove.Text = "Remove";
            this.btnRemove.UseVisualStyleBackColor = true;
            this.btnRemove.Click += new System.EventHandler(this.btnRemove_Click);
            // 
            // btnAdd
            // 
            this.btnAdd.Location = new System.Drawing.Point(85, 212);
            this.btnAdd.Name = "btnAdd";
            this.btnAdd.Size = new System.Drawing.Size(66, 23);
            this.btnAdd.TabIndex = 10;
            this.btnAdd.Text = "Add";
            this.btnAdd.UseVisualStyleBackColor = true;
            this.btnAdd.Click += new System.EventHandler(this.btnAdd_Click);
            // 
            // btnUpdate
            // 
            this.btnUpdate.Location = new System.Drawing.Point(157, 212);
            this.btnUpdate.Name = "btnUpdate";
            this.btnUpdate.Size = new System.Drawing.Size(66, 23);
            this.btnUpdate.TabIndex = 11;
            this.btnUpdate.Text = "Update";
            this.btnUpdate.UseVisualStyleBackColor = true;
            this.btnUpdate.Click += new System.EventHandler(this.btnUpdate_Click);
            // 
            // btnBack
            // 
            this.btnBack.Location = new System.Drawing.Point(12, 316);
            this.btnBack.Name = "btnBack";
            this.btnBack.Size = new System.Drawing.Size(57, 31);
            this.btnBack.TabIndex = 12;
            this.btnBack.Text = "< Back";
            this.btnBack.UseVisualStyleBackColor = true;
            this.btnBack.Click += new System.EventHandler(this.btnBack_Click);
            // 
            // labDoll
            // 
            this.labDoll.AutoSize = true;
            this.labDoll.BackColor = System.Drawing.Color.Transparent;
            this.labDoll.Font = new System.Drawing.Font("Microsoft Sans Serif", 12F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.labDoll.Location = new System.Drawing.Point(157, 145);
            this.labDoll.Name = "labDoll";
            this.labDoll.Size = new System.Drawing.Size(18, 20);
            this.labDoll.TabIndex = 13;
            this.labDoll.Text = "$";
            // 
            // labAmount
            // 
            this.labAmount.AutoSize = true;
            this.labAmount.BackColor = System.Drawing.Color.Transparent;
            this.labAmount.Font = new System.Drawing.Font("Microsoft Tai Le", 11.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.labAmount.ForeColor = System.Drawing.SystemColors.ControlText;
            this.labAmount.Location = new System.Drawing.Point(14, 177);
            this.labAmount.Name = "labAmount";
            this.labAmount.Size = new System.Drawing.Size(65, 19);
            this.labAmount.TabIndex = 15;
            this.labAmount.Text = "Amount:";
            // 
            // txtAmount
            // 
            this.txtAmount.Location = new System.Drawing.Point(85, 172);
            this.txtAmount.MaxLength = 4;
            this.txtAmount.Multiline = true;
            this.txtAmount.Name = "txtAmount";
            this.txtAmount.Size = new System.Drawing.Size(66, 24);
            this.txtAmount.TabIndex = 14;
            this.txtAmount.TextChanged += new System.EventHandler(this.txtAmount_TextChanged);
            // 
            // btnHistory
            // 
            this.btnHistory.Location = new System.Drawing.Point(683, 273);
            this.btnHistory.Name = "btnHistory";
            this.btnHistory.Size = new System.Drawing.Size(90, 23);
            this.btnHistory.TabIndex = 16;
            this.btnHistory.Text = "Show History";
            this.btnHistory.UseVisualStyleBackColor = true;
            this.btnHistory.Click += new System.EventHandler(this.btnHistory_Click);
            // 
            // btnShowPro
            // 
            this.btnShowPro.Location = new System.Drawing.Point(330, 273);
            this.btnShowPro.Name = "btnShowPro";
            this.btnShowPro.Size = new System.Drawing.Size(102, 23);
            this.btnShowPro.TabIndex = 17;
            this.btnShowPro.Text = "Show Products";
            this.btnShowPro.UseVisualStyleBackColor = true;
            this.btnShowPro.Click += new System.EventHandler(this.btnShowPro_Click);
            // 
            // RemoveHis
            // 
            this.RemoveHis.Location = new System.Drawing.Point(438, 273);
            this.RemoveHis.Name = "RemoveHis";
            this.RemoveHis.Size = new System.Drawing.Size(84, 23);
            this.RemoveHis.TabIndex = 18;
            this.RemoveHis.Text = "Delete";
            this.RemoveHis.UseVisualStyleBackColor = true;
            this.RemoveHis.Click += new System.EventHandler(this.RemoveHis_Click);
            // 
            // labSell
            // 
            this.labSell.AutoSize = true;
            this.labSell.BackColor = System.Drawing.Color.Transparent;
            this.labSell.Font = new System.Drawing.Font("Microsoft Sans Serif", 13F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.labSell.ForeColor = System.Drawing.Color.Transparent;
            this.labSell.Location = new System.Drawing.Point(245, 10);
            this.labSell.Name = "labSell";
            this.labSell.Size = new System.Drawing.Size(217, 22);
            this.labSell.TabIndex = 19;
            this.labSell.Text = "Amount sells of this week:";
            // 
            // ProductDash
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackgroundImage = global::Gimpies.Properties.Resources.background1;
            this.ClientSize = new System.Drawing.Size(794, 371);
            this.Controls.Add(this.labSell);
            this.Controls.Add(this.RemoveHis);
            this.Controls.Add(this.btnShowPro);
            this.Controls.Add(this.btnHistory);
            this.Controls.Add(this.labAmount);
            this.Controls.Add(this.txtAmount);
            this.Controls.Add(this.labDoll);
            this.Controls.Add(this.btnBack);
            this.Controls.Add(this.btnUpdate);
            this.Controls.Add(this.btnAdd);
            this.Controls.Add(this.btnRemove);
            this.Controls.Add(this.labPrice);
            this.Controls.Add(this.txtPrice);
            this.Controls.Add(this.labSize);
            this.Controls.Add(this.txtSize);
            this.Controls.Add(this.labColor);
            this.Controls.Add(this.txtColor);
            this.Controls.Add(this.labMark);
            this.Controls.Add(this.txtMark);
            this.Controls.Add(this.dataGridView);
            this.MaximumSize = new System.Drawing.Size(810, 410);
            this.MinimumSize = new System.Drawing.Size(800, 400);
            this.Name = "ProductDash";
            this.Text = "Products";
            this.FormClosing += new System.Windows.Forms.FormClosingEventHandler(this.Product_Closing);
            this.Load += new System.EventHandler(this.ProductDash_Load);
            ((System.ComponentModel.ISupportInitialize)(this.dataGridView)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.DataGridView dataGridView;
        private System.Windows.Forms.TextBox txtMark;
        private System.Windows.Forms.Label labMark;
        private System.Windows.Forms.Label labColor;
        private System.Windows.Forms.TextBox txtColor;
        private System.Windows.Forms.Label labSize;
        private System.Windows.Forms.TextBox txtSize;
        private System.Windows.Forms.Label labPrice;
        private System.Windows.Forms.TextBox txtPrice;
        private System.Windows.Forms.Button btnRemove;
        private System.Windows.Forms.Button btnAdd;
        private System.Windows.Forms.Button btnUpdate;
        private System.Windows.Forms.Button btnBack;
        private System.Windows.Forms.Label labDoll;
        private System.Windows.Forms.Label labAmount;
        private System.Windows.Forms.TextBox txtAmount;
        private System.Windows.Forms.Button btnHistory;
        private System.Windows.Forms.Button btnShowPro;
        private System.Windows.Forms.Button RemoveHis;
        private System.Windows.Forms.Label labSell;
    }
}