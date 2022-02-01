namespace Gimpies
{
    partial class Signup
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
            this.signLab = new System.Windows.Forms.Label();
            this.username = new System.Windows.Forms.TextBox();
            this.password = new System.Windows.Forms.TextBox();
            this.signBtn = new System.Windows.Forms.Button();
            this.userLab = new System.Windows.Forms.Label();
            this.label1 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.telnumber = new System.Windows.Forms.TextBox();
            this.label3 = new System.Windows.Forms.Label();
            this.email = new System.Windows.Forms.TextBox();
            this.btnBack = new System.Windows.Forms.Button();
            this.label4 = new System.Windows.Forms.Label();
            this.adress = new System.Windows.Forms.TextBox();
            this.label5 = new System.Windows.Forms.Label();
            this.city = new System.Windows.Forms.TextBox();
            this.SuspendLayout();
            // 
            // signLab
            // 
            this.signLab.AutoSize = true;
            this.signLab.BackColor = System.Drawing.Color.Transparent;
            this.signLab.Font = new System.Drawing.Font("Microsoft YaHei", 20F, System.Drawing.FontStyle.Bold);
            this.signLab.ForeColor = System.Drawing.SystemColors.ButtonFace;
            this.signLab.Location = new System.Drawing.Point(145, 45);
            this.signLab.Name = "signLab";
            this.signLab.Size = new System.Drawing.Size(119, 36);
            this.signLab.TabIndex = 0;
            this.signLab.Text = "Sign up";
            // 
            // username
            // 
            this.username.Location = new System.Drawing.Point(151, 99);
            this.username.MaxLength = 10;
            this.username.Name = "username";
            this.username.Size = new System.Drawing.Size(100, 20);
            this.username.TabIndex = 1;
            // 
            // password
            // 
            this.password.Location = new System.Drawing.Point(151, 125);
            this.password.MaxLength = 10;
            this.password.Name = "password";
            this.password.PasswordChar = '*';
            this.password.Size = new System.Drawing.Size(100, 20);
            this.password.TabIndex = 2;
            // 
            // signBtn
            // 
            this.signBtn.Location = new System.Drawing.Point(151, 255);
            this.signBtn.Name = "signBtn";
            this.signBtn.Size = new System.Drawing.Size(67, 27);
            this.signBtn.TabIndex = 3;
            this.signBtn.Text = "Add me!";
            this.signBtn.UseVisualStyleBackColor = true;
            this.signBtn.Click += new System.EventHandler(this.signBtn_Click);
            // 
            // userLab
            // 
            this.userLab.AutoSize = true;
            this.userLab.BackColor = System.Drawing.Color.Transparent;
            this.userLab.Font = new System.Drawing.Font("Calibri", 11.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.userLab.ForeColor = System.Drawing.Color.White;
            this.userLab.Location = new System.Drawing.Point(78, 101);
            this.userLab.Name = "userLab";
            this.userLab.Size = new System.Drawing.Size(49, 18);
            this.userLab.TabIndex = 4;
            this.userLab.Text = "Name:";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.BackColor = System.Drawing.Color.Transparent;
            this.label1.Font = new System.Drawing.Font("Calibri", 11.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.ForeColor = System.Drawing.Color.White;
            this.label1.Location = new System.Drawing.Point(56, 125);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(71, 18);
            this.label1.TabIndex = 5;
            this.label1.Text = "Password:";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.BackColor = System.Drawing.Color.Transparent;
            this.label2.Font = new System.Drawing.Font("Calibri", 11.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label2.ForeColor = System.Drawing.Color.White;
            this.label2.Location = new System.Drawing.Point(44, 153);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(83, 18);
            this.label2.TabIndex = 7;
            this.label2.Text = "Tel.number:";
            // 
            // telnumber
            // 
            this.telnumber.Location = new System.Drawing.Point(151, 151);
            this.telnumber.MaxLength = 10;
            this.telnumber.Name = "telnumber";
            this.telnumber.Size = new System.Drawing.Size(100, 20);
            this.telnumber.TabIndex = 6;
            this.telnumber.TextChanged += new System.EventHandler(this.telnumber_TextChanged);
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.BackColor = System.Drawing.Color.Transparent;
            this.label3.Font = new System.Drawing.Font("Calibri", 11.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label3.ForeColor = System.Drawing.Color.White;
            this.label3.Location = new System.Drawing.Point(81, 177);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(46, 18);
            this.label3.TabIndex = 9;
            this.label3.Text = "Email:";
            // 
            // email
            // 
            this.email.Location = new System.Drawing.Point(151, 177);
            this.email.MaxLength = 25;
            this.email.Name = "email";
            this.email.Size = new System.Drawing.Size(100, 20);
            this.email.TabIndex = 8;
            // 
            // btnBack
            // 
            this.btnBack.Location = new System.Drawing.Point(12, 302);
            this.btnBack.Name = "btnBack";
            this.btnBack.Size = new System.Drawing.Size(69, 27);
            this.btnBack.TabIndex = 10;
            this.btnBack.Text = "< Back";
            this.btnBack.UseVisualStyleBackColor = true;
            this.btnBack.Click += new System.EventHandler(this.btnBack_Click);
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.BackColor = System.Drawing.Color.Transparent;
            this.label4.Font = new System.Drawing.Font("Calibri", 11.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label4.ForeColor = System.Drawing.Color.White;
            this.label4.Location = new System.Drawing.Point(78, 203);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(54, 18);
            this.label4.TabIndex = 12;
            this.label4.Text = "Adress:";
            // 
            // adress
            // 
            this.adress.Location = new System.Drawing.Point(151, 203);
            this.adress.MaxLength = 15;
            this.adress.Name = "adress";
            this.adress.Size = new System.Drawing.Size(100, 20);
            this.adress.TabIndex = 11;
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.BackColor = System.Drawing.Color.Transparent;
            this.label5.Font = new System.Drawing.Font("Calibri", 11.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label5.ForeColor = System.Drawing.Color.White;
            this.label5.Location = new System.Drawing.Point(91, 229);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(36, 18);
            this.label5.TabIndex = 14;
            this.label5.Text = "City:";
            // 
            // city
            // 
            this.city.Location = new System.Drawing.Point(151, 229);
            this.city.MaxLength = 15;
            this.city.Name = "city";
            this.city.Size = new System.Drawing.Size(100, 20);
            this.city.TabIndex = 13;
            // 
            // Signup
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackgroundImage = global::Gimpies.Properties.Resources.background1;
            this.ClientSize = new System.Drawing.Size(374, 351);
            this.Controls.Add(this.label5);
            this.Controls.Add(this.city);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.adress);
            this.Controls.Add(this.btnBack);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.email);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.telnumber);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.userLab);
            this.Controls.Add(this.signBtn);
            this.Controls.Add(this.password);
            this.Controls.Add(this.username);
            this.Controls.Add(this.signLab);
            this.MaximumSize = new System.Drawing.Size(410, 410);
            this.MinimumSize = new System.Drawing.Size(390, 390);
            this.Name = "Signup";
            this.Text = "Gimpies";
            this.FormClosing += new System.Windows.Forms.FormClosingEventHandler(this.SignUp_Closing);
            this.Load += new System.EventHandler(this.Signup_Load);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label signLab;
        private System.Windows.Forms.TextBox username;
        private System.Windows.Forms.TextBox password;
        private System.Windows.Forms.Button signBtn;
        private System.Windows.Forms.Label userLab;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.TextBox telnumber;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.TextBox email;
        private System.Windows.Forms.Button btnBack;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.TextBox adress;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.TextBox city;
    }
}