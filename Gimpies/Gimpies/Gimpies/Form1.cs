using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Data.SqlClient;

namespace Gimpies
{
    public partial class Form1 : Form
    {
        SqlConnection con = new SqlConnection(@"Data Source=(LocalDB)\MSSQLLocalDB;AttachDbFilename=C:\Users\NOOBMASTER69\Documents\dpGimp.mdf;Integrated Security=True;");
        DataSet DS = new System.Data.DataSet();
   

        int attempts = 0;
        public static string EmailCheck = "";


        public Form1()
        {
            InitializeComponent();



        }

        private void btnLogin_Click(object sender, EventArgs e)
        {
            if (email.Text == "" || password.Text == "")
            {
                MessageBox.Show("Please write your login information!");
                email.Focus();
            }
            else
            {
                SqlCommand scmd = new SqlCommand("select count (*) as cnt from Users where Email=@Email and Password=@Password", con);
                scmd.Parameters.Clear();
                scmd.Parameters.AddWithValue("@Email", email.Text);
                scmd.Parameters.AddWithValue("@Password", password.Text);
                con.Open();


                if (email.Text == "admin" && password.Text == "admin")
                {
                    this.Hide();
                    var adm = new adminDash();
                    adm.ShowDialog();
                    this.Close();

                }

                else if (scmd.ExecuteScalar().ToString() == "1")
                {
                    this.Hide();
                    EmailCheck = email.Text;
                    var ingelod = new Form2();
                    ingelod.ShowDialog();
                    this.Close();
                    
                }
                else
                {
                    if (attempts++ >= 2)
                    {
                        MessageBox.Show("Failed 3 times to login! Please contact us if you forgot your info!", "Message", MessageBoxButtons.OK, MessageBoxIcon.Error);
                        Application.Exit();
                    }

                    else
                    {
                        MessageBox.Show("Wrong Username or Password " + attempts + " time", "Message", MessageBoxButtons.OK, MessageBoxIcon.Error);
                    }
                    con.Close();
                    email.Clear();
                    password.Clear();

                }


            }
        }

        private void password_TextChanged(object sender, EventArgs e)
        {

        }

        private void Form1_Load(object sender, EventArgs e)
        {
            this.AcceptButton = btnLogin;


        }




        private void newLab_Click(object sender, EventArgs e)
        {
            this.Hide();
            var signup = new Signup();
            signup.ShowDialog();
            this.Close();
        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void email_TextChanged(object sender, EventArgs e)
        {

        }

        private void Form1_Closing(object sender, FormClosingEventArgs e)
        {
            if (e.CloseReason == CloseReason.UserClosing)
            {
                if (MessageBox.Show("Are you sure you want to exit ?", "Confirmation",
                MessageBoxButtons.YesNo, MessageBoxIcon.Question) == DialogResult.Yes)
                { Application.Exit(); }
                else { e.Cancel = true; }
            }

        }
    }
}   



