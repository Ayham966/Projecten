namespace Gimpies
{
    partial class adminDash
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
            this.btnUsers = new System.Windows.Forms.Button();
            this.BtnProd = new System.Windows.Forms.Button();
            this.SignOut = new System.Windows.Forms.Button();
            this.pictureBox1 = new System.Windows.Forms.PictureBox();
            ((System.ComponentModel.ISupportInitialize)(this.pictureBox1)).BeginInit();
            this.SuspendLayout();
            // 
            // btnUsers
            // 
            this.btnUsers.Cursor = System.Windows.Forms.Cursors.Hand;
            this.btnUsers.Font = new System.Drawing.Font("Microsoft Sans Serif", 10F);
            this.btnUsers.Location = new System.Drawing.Point(91, 154);
            this.btnUsers.Name = "btnUsers";
            this.btnUsers.Size = new System.Drawing.Size(136, 47);
            this.btnUsers.TabIndex = 1;
            this.btnUsers.Text = "Users";
            this.btnUsers.UseVisualStyleBackColor = true;
            this.btnUsers.Click += new System.EventHandler(this.button2_Click);
            this.btnUsers.MouseLeave += new System.EventHandler(this.btnUsers_MouseLeave);
            this.btnUsers.MouseHover += new System.EventHandler(this.btnUsers_MouseHover);
            // 
            // BtnProd
            // 
            this.BtnProd.Cursor = System.Windows.Forms.Cursors.Hand;
            this.BtnProd.Font = new System.Drawing.Font("Microsoft Sans Serif", 10F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.BtnProd.Location = new System.Drawing.Point(293, 154);
            this.BtnProd.Name = "BtnProd";
            this.BtnProd.Size = new System.Drawing.Size(136, 47);
            this.BtnProd.TabIndex = 2;
            this.BtnProd.Text = "Products";
            this.BtnProd.UseVisualStyleBackColor = true;
            this.BtnProd.Click += new System.EventHandler(this.button1_Click);
            this.BtnProd.MouseLeave += new System.EventHandler(this.BtnProd_MouseLeave);
            this.BtnProd.MouseHover += new System.EventHandler(this.BtnProd_MouseHover);
            // 
            // SignOut
            // 
            this.SignOut.Location = new System.Drawing.Point(406, 273);
            this.SignOut.Name = "SignOut";
            this.SignOut.Size = new System.Drawing.Size(85, 29);
            this.SignOut.TabIndex = 3;
            this.SignOut.Text = "Sign Out";
            this.SignOut.UseVisualStyleBackColor = true;
            this.SignOut.Click += new System.EventHandler(this.SignOut_Click);
            // 
            // pictureBox1
            // 
            this.pictureBox1.BackColor = System.Drawing.Color.Transparent;
            this.pictureBox1.Image = global::Gimpies.Properties.Resources.adminLogo;
            this.pictureBox1.Location = new System.Drawing.Point(107, 12);
            this.pictureBox1.Name = "pictureBox1";
            this.pictureBox1.Size = new System.Drawing.Size(282, 119);
            this.pictureBox1.SizeMode = System.Windows.Forms.PictureBoxSizeMode.Zoom;
            this.pictureBox1.TabIndex = 4;
            this.pictureBox1.TabStop = false;
            // 
            // adminDash
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackgroundImage = global::Gimpies.Properties.Resources.background1;
            this.ClientSize = new System.Drawing.Size(514, 321);
            this.Controls.Add(this.pictureBox1);
            this.Controls.Add(this.SignOut);
            this.Controls.Add(this.BtnProd);
            this.Controls.Add(this.btnUsers);
            this.MaximumSize = new System.Drawing.Size(530, 360);
            this.MinimumSize = new System.Drawing.Size(510, 350);
            this.Name = "adminDash";
            this.Text = "Admin Dashboard";
            this.FormClosing += new System.Windows.Forms.FormClosingEventHandler(this.Dash_Closing);
            this.Load += new System.EventHandler(this.adminDash_Load);
            ((System.ComponentModel.ISupportInitialize)(this.pictureBox1)).EndInit();
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.Button btnUsers;
        private System.Windows.Forms.Button BtnProd;
        private System.Windows.Forms.Button SignOut;
        private System.Windows.Forms.PictureBox pictureBox1;
    }
}