using System.Runtime.InteropServices.WindowsRuntime;
using System.Windows.Forms;

namespace Gimpies
{
    partial class Form2
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
            this.btnChoose = new System.Windows.Forms.Button();
            this.label1 = new System.Windows.Forms.Label();
            this.kortLab = new System.Windows.Forms.Label();
            this.markCom = new System.Windows.Forms.ComboBox();
            this.button1 = new System.Windows.Forms.Button();
            this.dataGridView = new System.Windows.Forms.DataGridView();
            this.btnBuy = new System.Windows.Forms.Button();
            this.numericUpDown1 = new System.Windows.Forms.NumericUpDown();
            this.btnProf = new System.Windows.Forms.Button();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridView)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.numericUpDown1)).BeginInit();
            this.SuspendLayout();
            // 
            // btnChoose
            // 
            this.btnChoose.Location = new System.Drawing.Point(12, 64);
            this.btnChoose.Name = "btnChoose";
            this.btnChoose.Size = new System.Drawing.Size(75, 23);
            this.btnChoose.TabIndex = 3;
            this.btnChoose.Text = "Choose";
            this.btnChoose.UseVisualStyleBackColor = true;
            this.btnChoose.Click += new System.EventHandler(this.addBtn_Click);
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.BackColor = System.Drawing.Color.Transparent;
            this.label1.Font = new System.Drawing.Font("Segoe UI Semibold", 10F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.ForeColor = System.Drawing.SystemColors.ButtonHighlight;
            this.label1.Location = new System.Drawing.Point(9, 15);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(45, 19);
            this.label1.TabIndex = 11;
            this.label1.Text = "Mark:";
            // 
            // kortLab
            // 
            this.kortLab.AutoSize = true;
            this.kortLab.BackColor = System.Drawing.Color.Transparent;
            this.kortLab.Font = new System.Drawing.Font("Segoe UI Emoji", 10F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.kortLab.Location = new System.Drawing.Point(9, 333);
            this.kortLab.Name = "kortLab";
            this.kortLab.Size = new System.Drawing.Size(198, 19);
            this.kortLab.TabIndex = 17;
            this.kortLab.Text = "Tip: There is discount on white!";
            // 
            // markCom
            // 
            this.markCom.BackColor = System.Drawing.SystemColors.MenuBar;
            this.markCom.DropDownStyle = System.Windows.Forms.ComboBoxStyle.DropDownList;
            this.markCom.FormattingEnabled = true;
            this.markCom.Items.AddRange(new object[] {
            "Schoenen",
            "Jassen"});
            this.markCom.Location = new System.Drawing.Point(13, 36);
            this.markCom.Name = "markCom";
            this.markCom.Size = new System.Drawing.Size(75, 21);
            this.markCom.TabIndex = 18;
            this.markCom.SelectedIndexChanged += new System.EventHandler(this.markCom_SelectedIndexChanged);
            // 
            // button1
            // 
            this.button1.Location = new System.Drawing.Point(507, 329);
            this.button1.Name = "button1";
            this.button1.Size = new System.Drawing.Size(75, 23);
            this.button1.TabIndex = 19;
            this.button1.Text = "Sign out";
            this.button1.UseVisualStyleBackColor = true;
            this.button1.Click += new System.EventHandler(this.button1_Click);
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
            this.dataGridView.Location = new System.Drawing.Point(12, 93);
            this.dataGridView.Name = "dataGridView";
            this.dataGridView.ReadOnly = true;
            this.dataGridView.RowHeadersVisible = false;
            this.dataGridView.RowHeadersWidthSizeMode = System.Windows.Forms.DataGridViewRowHeadersWidthSizeMode.AutoSizeToAllHeaders;
            this.dataGridView.SelectionMode = System.Windows.Forms.DataGridViewSelectionMode.FullRowSelect;
            this.dataGridView.Size = new System.Drawing.Size(444, 196);
            this.dataGridView.TabIndex = 20;
            this.dataGridView.CellContentClick += new System.Windows.Forms.DataGridViewCellEventHandler(this.dataGridView_CellContentClick);
            // 
            // btnBuy
            // 
            this.btnBuy.Location = new System.Drawing.Point(381, 295);
            this.btnBuy.Name = "btnBuy";
            this.btnBuy.Size = new System.Drawing.Size(75, 23);
            this.btnBuy.TabIndex = 21;
            this.btnBuy.Text = "Buy";
            this.btnBuy.UseVisualStyleBackColor = true;
            this.btnBuy.Click += new System.EventHandler(this.btnBuy_Click);
            // 
            // numericUpDown1
            // 
            this.numericUpDown1.Location = new System.Drawing.Point(324, 298);
            this.numericUpDown1.Maximum = new decimal(new int[] {
            5,
            0,
            0,
            0});
            this.numericUpDown1.Minimum = new decimal(new int[] {
            1,
            0,
            0,
            0});
            this.numericUpDown1.Name = "numericUpDown1";
            this.numericUpDown1.ReadOnly = true;
            this.numericUpDown1.Size = new System.Drawing.Size(51, 20);
            this.numericUpDown1.TabIndex = 22;
            this.numericUpDown1.TextAlign = System.Windows.Forms.HorizontalAlignment.Center;
            this.numericUpDown1.Value = new decimal(new int[] {
            1,
            0,
            0,
            0});
            // 
            // btnProf
            // 
            this.btnProf.Location = new System.Drawing.Point(507, 13);
            this.btnProf.Name = "btnProf";
            this.btnProf.Size = new System.Drawing.Size(75, 23);
            this.btnProf.TabIndex = 24;
            this.btnProf.Text = "Profile";
            this.btnProf.UseVisualStyleBackColor = true;
            this.btnProf.Click += new System.EventHandler(this.btnProf_Click);
            // 
            // Form2
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackgroundImage = global::Gimpies.Properties.Resources.background1;
            this.ClientSize = new System.Drawing.Size(594, 361);
            this.Controls.Add(this.btnProf);
            this.Controls.Add(this.numericUpDown1);
            this.Controls.Add(this.btnBuy);
            this.Controls.Add(this.dataGridView);
            this.Controls.Add(this.button1);
            this.Controls.Add(this.markCom);
            this.Controls.Add(this.kortLab);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.btnChoose);
            this.MaximumSize = new System.Drawing.Size(730, 430);
            this.MinimumSize = new System.Drawing.Size(610, 400);
            this.Name = "Form2";
            this.SizeGripStyle = System.Windows.Forms.SizeGripStyle.Hide;
            this.Text = "Gimpies";
            this.FormClosing += new System.Windows.Forms.FormClosingEventHandler(this.Form2_Closing);
            this.Load += new System.EventHandler(this.Form2_Load);
            ((System.ComponentModel.ISupportInitialize)(this.dataGridView)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.numericUpDown1)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion
        private System.Windows.Forms.Button btnChoose;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label kortLab;
        private System.Windows.Forms.ComboBox markCom;
        private Button button1;
        private DataGridView dataGridView;
        private Button btnBuy;
        private NumericUpDown numericUpDown1;
        private Button btnProf;
    }
}