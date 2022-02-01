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
    public partial class Signup : Form
    {
        SqlConnection con = new SqlConnection(@"Data Source=(LocalDB)\MSSQLLocalDB;AttachDbFilename=C:\Users\NOOBMASTER69\Documents\dpGimp.mdf;Integrated Security=True;");
        DataSet DS = new System.Data.DataSet();
        SqlCommand cmd;
        public Signup()
        {
            InitializeComponent();
        }
     

        private void signBtn_Click(object sender, EventArgs e)
        {
            if (username.Text != "" && password.Text != "" && telnumber.Text != "" && email.Text != "" && adress.Text != "" && city.Text != "")
            {
                cmd = new SqlCommand("Select count(*) from Users where Email= @Email", con);
                cmd.Parameters.AddWithValue("@Email", this.email.Text);
                con.Open();
                int result = 0;
                result = Convert.ToInt32(cmd.ExecuteScalar());
                if (result > 0)
                {
                    cmd.ExecuteNonQuery();
                    con.Close();
                    MessageBox.Show("Email is Already exist");
                    email.Text = "";
                    email.Focus();
                }
                
                else
                {
                cmd = new SqlCommand("insert into Users(Name,Password,Telnumber,Email,Adress,City) values(@Name,@Password,@Telnumber,@Email,@Adress,@City)", con);
               

                cmd.Parameters.AddWithValue("@Name", username.Text);
                cmd.Parameters.AddWithValue("@Password", password.Text);
                cmd.Parameters.AddWithValue("@Telnumber", telnumber.Text);
                cmd.Parameters.AddWithValue("@Email", email.Text);
                cmd.Parameters.AddWithValue("@Adress", adress.Text);
                cmd.Parameters.AddWithValue("@City", city.Text);
                cmd.ExecuteNonQuery();
                con.Close();
                MessageBox.Show("Added Successfully, Welcome " + username.Text + "!");
                ClearData();
                this.Hide();
                var back = new Form1();
                back.ShowDialog();
                this.Close();
                }






            }
            else
            {
                MessageBox.Show("Please fill all informations");
            }

        }
        private void ClearData()
        {
            username.Text = "";
            password.Text = "";
            telnumber.Text = "";
            email.Text = "";
            adress.Text = "";
            city.Text = "";

        }

        private void Signup_Load(object sender, EventArgs e)
        {
            this.AcceptButton = signBtn;
        }

        private void telnumber_TextChanged(object sender, EventArgs e)
        {
            if (System.Text.RegularExpressions.Regex.IsMatch(telnumber.Text, "[^0-9]"))
            {
                MessageBox.Show("Please enter only numbers.");
                telnumber.Text = telnumber.Text.Remove(telnumber.Text.Length - 1);
            }
        }

        private void btnBack_Click(object sender, EventArgs e)
        {
            this.Hide();
            var back = new Form1();
            back.ShowDialog();
            this.Close();


        }

        private void SignUp_Closing(object sender, FormClosingEventArgs e)
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
