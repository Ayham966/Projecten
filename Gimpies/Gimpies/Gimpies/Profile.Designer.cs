namespace Gimpies
{
    partial class Profile
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
            this.Prof = new System.Windows.Forms.Label();
            this.label5 = new System.Windows.Forms.Label();
            this.city = new System.Windows.Forms.TextBox();
            this.label4 = new System.Windows.Forms.Label();
            this.adress = new System.Windows.Forms.TextBox();
            this.label3 = new System.Windows.Forms.Label();
            this.email = new System.Windows.Forms.TextBox();
            this.label2 = new System.Windows.Forms.Label();
            this.telnumber = new System.Windows.Forms.TextBox();
            this.label1 = new System.Windows.Forms.Label();
            this.userLab = new System.Windows.Forms.Label();
            this.password = new System.Windows.Forms.TextBox();
            this.username = new System.Windows.Forms.TextBox();
            this.button1 = new System.Windows.Forms.Button();
            this.checkBox1 = new System.Windows.Forms.CheckBox();
            this.SuspendLayout();
            // 
            // Prof
            // 
            this.Prof.AutoSize = true;
            this.Prof.BackColor = System.Drawing.Color.Transparent;
            this.Prof.Font = new System.Drawing.Font("Microsoft YaHei", 20F, System.Drawing.FontStyle.Bold);
            this.Prof.ForeColor = System.Drawing.SystemColors.ButtonFace;
            this.Prof.Location = new System.Drawing.Point(139, 40);
            this.Prof.Name = "Prof";
            this.Prof.Size = new System.Drawing.Size(105, 36);
            this.Prof.TabIndex = 1;
            this.Prof.Text = "Profile";
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.BackColor = System.Drawing.Color.Transparent;
            this.label5.Font = new System.Drawing.Font("Calibri", 11.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label5.ForeColor = System.Drawing.Color.White;
            this.label5.Location = new System.Drawing.Point(87, 225);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(36, 18);
            this.label5.TabIndex = 26;
            this.label5.Text = "City:";
            // 
            // city
            // 
            this.city.Location = new System.Drawing.Point(147, 225);
            this.city.MaxLength = 15;
            this.city.Name = "city";
            this.city.Size = new System.Drawing.Size(100, 20);
            this.city.TabIndex = 25;
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.BackColor = System.Drawing.Color.Transparent;
            this.label4.Font = new System.Drawing.Font("Calibri", 11.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label4.ForeColor = System.Drawing.Color.White;
            this.label4.Location = new System.Drawing.Point(74, 199);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(54, 18);
            this.label4.TabIndex = 24;
            this.label4.Text = "Adress:";
            // 
            // adress
            // 
            this.adress.Location = new System.Drawing.Point(147, 199);
            this.adress.MaxLength = 15;
            this.adress.Name = "adress";
            this.adress.Size = new System.Drawing.Size(100, 20);
            this.adress.TabIndex = 23;
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.BackColor = System.Drawing.Color.Transparent;
            this.label3.Font = new System.Drawing.Font("Calibri", 11.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label3.ForeColor = System.Drawing.Color.White;
            this.label3.Location = new System.Drawing.Point(77, 173);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(46, 18);
            this.label3.TabIndex = 22;
            this.label3.Text = "Email:";
            // 
            // email
            // 
            this.email.BackColor = System.Drawing.Color.White;
            this.email.Location = new System.Drawing.Point(147, 173);
            this.email.MaxLength = 25;
            this.email.Name = "email";
            this.email.ReadOnly = true;
            this.email.Size = new System.Drawing.Size(100, 20);
            this.email.TabIndex = 21;
            this.email.TextChanged += new System.EventHandler(this.email_TextChanged);
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.BackColor = System.Drawing.Color.Transparent;
            this.label2.Font = new System.Drawing.Font("Calibri", 11.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label2.ForeColor = System.Drawing.Color.White;
            this.label2.Location = new System.Drawing.Point(40, 147);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(83, 18);
            this.label2.TabIndex = 20;
            this.label2.Text = "Tel.number:";
            // 
            // telnumber
            // 
            this.telnumber.Location = new System.Drawing.Point(147, 147);
            this.telnumber.MaxLength = 10;
            this.telnumber.Name = "telnumber";
            this.telnumber.Size = new System.Drawing.Size(100, 20);
            this.telnumber.TabIndex = 19;
            this.telnumber.TextChanged += new System.EventHandler(this.telnumber_TextChanged);
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.BackColor = System.Drawing.Color.Transparent;
            this.label1.Font = new System.Drawing.Font("Calibri", 11.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.ForeColor = System.Drawing.Color.White;
            this.label1.Location = new System.Drawing.Point(52, 121);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(71, 18);
            this.label1.TabIndex = 18;
            this.label1.Text = "Password:";
            // 
            // userLab
            // 
            this.userLab.AutoSize = true;
            this.userLab.BackColor = System.Drawing.Color.Transparent;
            this.userLab.Font = new System.Drawing.Font("Calibri", 11.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.userLab.ForeColor = System.Drawing.Color.White;
            this.userLab.Location = new System.Drawing.Point(74, 95);
            this.userLab.Name = "userLab";
            this.userLab.Size = new System.Drawing.Size(49, 18);
            this.userLab.TabIndex = 17;
            this.userLab.Text = "Name:";
            // 
            // password
            // 
            this.password.Location = new System.Drawing.Point(147, 121);
            this.password.MaxLength = 10;
            this.password.Name = "password";
            this.password.PasswordChar = '*';
            this.password.Size = new System.Drawing.Size(100, 20);
            this.password.TabIndex = 16;
            // 
            // username
            // 
            this.username.Location = new System.Drawing.Point(147, 95);
            this.username.MaxLength = 10;
            this.username.Name = "username";
            this.username.Size = new System.Drawing.Size(100, 20);
            this.username.TabIndex = 15;
            // 
            // button1
            // 
            this.button1.Location = new System.Drawing.Point(147, 251);
            this.button1.Name = "button1";
            this.button1.Size = new System.Drawing.Size(75, 23);
            this.button1.TabIndex = 27;
            this.button1.Text = "Edit";
            this.button1.UseVisualStyleBackColor = true;
            this.button1.Click += new System.EventHandler(this.button1_Click);
            // 
            // checkBox1
            // 
            this.checkBox1.AutoSize = true;
            this.checkBox1.BackColor = System.Drawing.Color.Transparent;
            this.checkBox1.Location = new System.Drawing.Point(253, 124);
            this.checkBox1.Name = "checkBox1";
            this.checkBox1.Size = new System.Drawing.Size(102, 17);
            this.checkBox1.TabIndex = 28;
            this.checkBox1.Text = "Show Password";
            this.checkBox1.UseVisualStyleBackColor = false;
            this.checkBox1.CheckedChanged += new System.EventHandler(this.checkBox1_CheckedChanged);
            // 
            // Profile
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackgroundImage = global::Gimpies.Properties.Resources.background1;
            this.ClientSize = new System.Drawing.Size(387, 366);
            this.Controls.Add(this.checkBox1);
            this.Controls.Add(this.button1);
            this.Controls.Add(this.label5);
            this.Controls.Add(this.city);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.adress);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.email);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.telnumber);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.userLab);
            this.Controls.Add(this.password);
            this.Controls.Add(this.username);
            this.Controls.Add(this.Prof);
            this.Name = "Profile";
            this.Text = "Profile";
            this.Load += new System.EventHandler(this.Profile_Load);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label Prof;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.TextBox city;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.TextBox adress;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.TextBox email;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.TextBox telnumber;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label userLab;
        private System.Windows.Forms.TextBox password;
        private System.Windows.Forms.TextBox username;
        private System.Windows.Forms.Button button1;
        private System.Windows.Forms.CheckBox checkBox1;
    }
}