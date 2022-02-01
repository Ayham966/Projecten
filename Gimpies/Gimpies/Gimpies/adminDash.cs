using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Gimpies
{
    public partial class adminDash : Form
    {
        public adminDash()
        {
            InitializeComponent();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            this.Hide();
            var loadUsers = new adminForm();
            loadUsers.ShowDialog();
            this.Close();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            this.Hide();
            var loadProduct = new ProductDash();
            loadProduct.ShowDialog();
            this.Close();
        }

        private void SignOut_Click(object sender, EventArgs e)
        {
            this.Hide();
            var back = new Form1();
            back.ShowDialog();
            this.Close();        
        }

        private void adminDash_Load(object sender, EventArgs e)
        {

        }

        private void Dash_Closing(object sender, FormClosingEventArgs e)
        {
            
                if (e.CloseReason == CloseReason.UserClosing)
                {
                    if (MessageBox.Show("Are you sure you want to exit ?", "Confirmation",
                    MessageBoxButtons.YesNo, MessageBoxIcon.Question) == DialogResult.Yes)
                    { Application.Exit(); }
                    else { e.Cancel = true; }
                }

           
        }

        private void btnUsers_MouseHover(object sender, EventArgs e)
        {
            btnUsers.BackColor = Color.NavajoWhite;
        }

        private void btnUsers_MouseLeave(object sender, EventArgs e)
        {
            btnUsers.BackColor = Color.Beige;
        }

        private void BtnProd_MouseHover(object sender, EventArgs e)
        {
            BtnProd.BackColor = Color.NavajoWhite;
        }

        private void BtnProd_MouseLeave(object sender, EventArgs e)
        {
            BtnProd.BackColor = Color.Beige;
        }
    }
}
